<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\URL;
use App\Models\Visitor;
use App\Http\Requests\CreateUrlRequest;
use App\Http\Requests\UpdateUrlRequest;
use App\Events\UrlCreation;
use App\Jobs\SendUrlCreated;
use App\Mail\UrlCreatedMarkdownMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class urlpageController extends Controller
{
    public function index()
    {
        // Ensure the user is authenticated
        $user_id = auth()->user()->id;
        Log::info($user_id);

        // Cache the URLs
        $urls = Cache::remember('urls', 2, function() use ($user_id) {
            return URL::where('user_id', $user_id)->paginate(5);
        });

        $count = URL::where('user_id', $user_id)->count();
        return view('urls.index', compact('urls', 'count'));
    }

    public function view($id)
    {
        $url = URL::findOrFail($id);
        if ($url->user_id != auth()->user()->id) {
            abort(403);
        }
        return view('urls.view', compact('url'));
    }

    public function create()
    {
        return view('urls.create');
    }

    public function store(CreateUrlRequest $request)
    {
        $ran_string = Str::random(8);

        $url = URL::create([
            'original_url' => $request->url,
            'short_url' => $ran_string,
            'user_id' => auth()->user()->id // Ensure the URL is associated with the authenticated user
        ]);

        $user = auth()->user();

        /* Mail::to($user)->send(new UrlCreatedMarkdownMail($url)); */
        SendUrlCreated::dispatch($user,$url);
        UrlCreation::dispatch($url);  // Event dispatched

        Cache::forget('urls'); // Clear the cache when a new URL is created

        return redirect()->action([urlpageController::class, 'index']);
    }

    public function edit($id)
    {
        $url = URL::findOrFail($id);
        // Checks if user is accessing its own data or not
        if ($url->user_id != auth()->user()->id) {
            abort(403);
        }

        return view('urls.edit', compact('url'));
    }

    public function update(UpdateUrlRequest $request, $id)
    {
        $url = URL::findOrFail($id);
        $url->original_url = $request->url;
        $url->save();

        $request->session()->flash('success', 'URL was updated successfully');
        Cache::forget('urls'); // Clear the cache when a URL is updated

        return redirect()->action([urlpageController::class, 'index']);
    }

    public function destroy(Request $request, $id)
    {
        $url = URL::findOrFail($id);
        if ($url->user_id != auth()->user()->id) {
            abort(401);
        }

        // Delete all visitors that reference this URL
        Visitor::where('url_id', $id)->delete();
        $url->delete();

        $request->session()->flash('success', 'URL was deleted successfully');
        Cache::forget('urls'); // Clear the cache when a URL is deleted

        return redirect()->action([urlpageController::class, 'index']);
    }

    public function redirect(Request $request, $short_url)
    {
        $url = URL::where('short_url', $short_url)->first();

        if ($url) {
            // Record IP and user agent
            Visitor::create([
                'url_id' => $url->id,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
            // Increment count of visitors
            $url->increment('visitor_count');
            return redirect()->away($url->original_url);
        }
        abort(401);
    }
}
