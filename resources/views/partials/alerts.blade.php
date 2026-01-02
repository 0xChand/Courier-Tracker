@if(session('status'))
    <div class="mb-4 p-3 rounded bg-emerald-800 text-emerald-100 border border-emerald-600/50">
        {{ session('status') }}
    </div>
@endif

@if(session('success'))
    <div class="mb-4 p-3 rounded bg-emerald-800 text-emerald-100 border border-emerald-600/50">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-3 rounded bg-red-800 text-red-100 border border-red-600/50">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-4 p-3 rounded bg-red-900 text-red-100 border border-red-600/50">
        <ul class="list-disc list-inside space-y-1 mb-0">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif
