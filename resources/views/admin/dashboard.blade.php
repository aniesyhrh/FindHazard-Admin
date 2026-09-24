<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="10"> <!-- Auto-updates Display 2 every 10s -->
    <title>FindHazard VR — Supervisor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-neutral-950 text-neutral-100 font-sans min-h-screen p-6 antialiased">
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- Top Navigation Bar -->
        <header class="flex flex-wrap justify-between items-center bg-neutral-900 border border-neutral-800 p-5 rounded-xl shadow-lg">
            <div>
                <div class="flex items-center space-x-3">
                    <span class="inline-block w-3 h-3 bg-yellow-500 rounded-full animate-pulse"></span>
                    <h1 class="text-xl font-black tracking-wider text-yellow-500 uppercase">FindHazard VR — Admin Center</h1>
                </div>
                <p class="text-xs text-neutral-400 mt-1">Live Worker Performance Monitoring & Evaluation System</p>
            </div>
            <div class="flex items-center space-x-3 mt-4 md:mt-0">
                <span class="text-xs font-mono bg-neutral-800 text-neutral-300 px-3 py-1.5 rounded-md border border-neutral-700">
                    Dashboard Mode (Live Sync)
                </span>
                <button onclick="window.location.reload()" class="bg-yellow-500 hover:bg-yellow-400 text-neutral-950 font-bold px-3 py-1.5 rounded-md text-xs transition">
                    Sync Now
                </button>
            </div>
        </header>

        <!-- Summary Metric Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-neutral-900 border border-neutral-800 p-5 rounded-xl">
                <p class="text-xs text-neutral-400 uppercase font-semibold">Total Sessions</p>
                <p class="text-3xl font-black text-white mt-1">{{ $totalSessions }}</p>
            </div>

            <div class="bg-neutral-900 border border-neutral-800 p-5 rounded-xl">
                <p class="text-xs text-neutral-400 uppercase font-semibold">Average Final Score</p>
                <p class="text-3xl font-black text-emerald-400 mt-1">{{ number_format($avgScore, 0) }} pts</p>
            </div>

            <div class="bg-neutral-900 border border-neutral-800 p-5 rounded-xl">
                <p class="text-xs text-neutral-400 uppercase font-semibold">Avg Completion Time</p>
                <p class="text-3xl font-black text-sky-400 mt-1">{{ number_format($avgTime, 1) }}s</p>
            </div>

            <div class="bg-neutral-900 border border-neutral-800 p-5 rounded-xl">
                <p class="text-xs text-neutral-400 uppercase font-semibold">Hazards Spotted</p>
                <p class="text-3xl font-black text-yellow-400 mt-1">{{ $totalHazardsFound }}</p>
            </div>
        </div>

        <!-- Trainee Evaluation Table -->
        <div class="bg-neutral-900 border border-neutral-800 rounded-xl overflow-hidden shadow-xl">
            <div class="p-4 border-b border-neutral-800">
                <h2 class="text-sm font-bold uppercase tracking-wider text-neutral-300">Trainee Records Log</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-neutral-800/60 text-neutral-400 text-xs uppercase tracking-wider">
                            <th class="p-3.5">Trainee Name</th>
                            <th class="p-3.5">Score</th>
                            <th class="p-3.5">Found</th>
                            <th class="p-3.5">Missed</th>
                            <th class="p-3.5">Time Taken</th>
                            <th class="p-3.5">Status Evaluation</th>
                            <th class="p-3.5">Session Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-800 text-neutral-300">
                        @forelse($records as $row)
                            <tr class="hover:bg-neutral-800/40 transition">
                                <td class="p-3.5 font-bold text-white">{{ $row->username }}</td>
                                <td class="p-3.5 font-semibold text-emerald-400">{{ $row->score }}</td>
                                <td class="p-3.5 text-neutral-200">{{ $row->hazards_found }}</td>
                                <td class="p-3.5 text-rose-400 font-medium">{{ $row->hazards_missed }}</td>
                                <td class="p-3.5 font-mono">{{ number_format($row->completion_time, 1) }}s</td>
                                <td class="p-3.5">
                                    <span class="px-2.5 py-1 text-xs font-bold rounded-md
                                        @if($row->performance_rating === 'Locked In') bg-emerald-950 text-emerald-300 border border-emerald-800
                                        @elseif($row->performance_rating === 'Great') bg-sky-950 text-sky-300 border border-sky-800
                                        @elseif($row->performance_rating === 'Valid Effort') bg-amber-950 text-amber-300 border border-amber-800
                                        @else bg-rose-950 text-rose-300 border border-rose-800 @endif">
                                        {{ $row->performance_rating }}
                                    </span>
                                </td>
                                <td class="p-3.5 text-neutral-400 text-xs">{{ $row->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-8 text-center text-neutral-500 font-medium">
                                    No trainee training sessions logged yet. Waiting for VR clients to connect...
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($records->hasPages())
                <div class="p-4 border-t border-neutral-800">
                    {{ $records->links() }}
                </div>
            @endif
        </div>
    </div>
</body>
</html>
