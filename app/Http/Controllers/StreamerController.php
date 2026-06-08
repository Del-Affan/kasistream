<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Support\Facades\Auth;
use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;


class StreamerController extends Controller
{
    public function dashboard()
    {
        $streamerId = Auth::id();

        $totalDonasi = Donasi::where('streamer_id', $streamerId)
            ->sum('nominal');

        $totalTransaksi = Donasi::where('streamer_id', $streamerId)
            ->count();

        $totalDonatur = Donasi::where('streamer_id', $streamerId)
            ->distinct('user_id')
            ->count('user_id');

        $donasiTerbaru = Donasi::with('user')
            ->where('streamer_id', $streamerId)
            ->latest()
            ->take(10)
            ->get();

        return view(
            'streamer-dashboard',
            compact(
                'totalDonasi',
                'totalTransaksi',
                'totalDonatur',
                'donasiTerbaru'
            )
        );
    }

    public function donations()
        {
            $donasi = \App\Models\Donasi::with('user')
                ->where('streamer_id', auth()->id())
                ->latest()
                ->paginate(10);

            return view('streamer-donations', compact('donasi'));
        }


        public function statistics()
        {
            $streamerId = auth()->id();

            $totalDonasi = \App\Models\Donasi::where(
                'streamer_id',
                $streamerId
            )->sum('nominal');

            $donasiTerbesar = \App\Models\Donasi::where(
                'streamer_id',
                $streamerId
            )->max('nominal');

            $rataRataDonasi = \App\Models\Donasi::where(
                'streamer_id',
                $streamerId
            )->avg('nominal');

            $topDonatur = \App\Models\Donasi::with('user')
            ->where('streamer_id', $streamerId)
            ->selectRaw('user_id, guest_name, SUM(nominal) as total')
            ->groupBy('user_id', 'guest_name')
            ->orderByDesc('total')
            ->take(10)
            ->get();

            return view(
                'streamer-statistics',
                compact(
                    'totalDonasi',
                    'donasiTerbesar',
                    'rataRataDonasi',
                    'topDonatur'
                )
            );
        }

        public function follow($id)
{
        $exists = Follower::where(
            'user_id',
            auth()->id()
        )
        ->where(
            'streamer_id',
            $id
        )
        ->exists();

        if(!$exists){

            Follower::create([

                'user_id' => auth()->id(),

                'streamer_id' => $id

            ]);

            $streamer = User::findOrFail($id);

            $streamer->followers += 1;

            $streamer->save();
        }

        return back();
    }

    public function unfollow($id)
{
        $deleted = Follower::where(
            'user_id',
            auth()->id()
        )
        ->where(
            'streamer_id',
            $id
        )
        ->delete();

        if($deleted){

            $streamer = User::findOrFail($id);

            if($streamer->followers > 0){

                $streamer->followers -= 1;

                $streamer->save();
            }
        }

        return back();
    }

    public function index(Request $request)
{
    $query = User::where(
        'is_streamer',
        1
    );

    if($request->search){

        $query->where(
            'name',
            'like',
            '%' . $request->search . '%'
        );
    }

    if($request->game){

        $query->where(
            'game',
            $request->game
        );
    }

    $streamers = $query
        ->orderByDesc('followers')
        ->paginate(12);

    $games = User::where(
        'is_streamer',
        1
    )
    ->whereNotNull('game')
    ->distinct()
    ->pluck('game');

    return view(
        'streamers',
        compact(
            'streamers',
            'games'
        )
    );
}

public function following()
{
    $streamerIds = Follower::where(
        'user_id',
        auth()->id()
    )->pluck('streamer_id');

    $streamers = User::whereIn(
        'id',
        $streamerIds
    )
    ->paginate(12);

    return view(
        'following',
        compact('streamers')
    );
}

}