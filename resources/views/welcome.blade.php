@include('layouts.topper')

@foreach ($data as $item)
    <div class="p-6 border-gray-200">
        <div class="flex items-center">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500">
                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">
                <a target="_blank" href="{{ $item['url'] }}" class="underline text-gray-900 dark:text-white">{{ $item['url'] }}</a>
            </div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                <p class="dark:text-white">Method POST , Use Postman.</p>
                <pre>{{ $item['request'] }}</pre>
                <p class="dark:text-white">Response</p>
                <pre>{{ $item['response'] }}</pre>
            </div>
        </div>
    </div>
@endforeach

@include('layouts.bottom')
