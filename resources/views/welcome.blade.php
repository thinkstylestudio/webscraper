<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    {{--    <link href="https://tailwindcss.com/_next/static/css/709798762af699a54fcb.css" rel="preload">--}}
{{--    <link href="https://tailwindcss.com/_next/static/css/709798762af699a54fcb.css" rel="stylesheet">--}}


</head>
<body class="antialiased">

<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">


    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="p-6">
                <div class="flex items-center">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                         stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500">
                        <path
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel.com/docs"
                                                                         class="underline text-gray-900 dark:text-white">Scraper</a>
                    </div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                        <table class="table-auto">
                            <thead>
                            <tr>
                                <th class="px-4 py-2">Uri</th>
                                <th class="px-4 py-2">Status Code</th>
                                <th class="px-4 py-2">Request Time</th>
                                <th class="px-4 py-2">Internal Link Count</th>
                                <th class="px-4 py-2">External Link Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($elements as $element)
                                <tr>
                                    <td>{{ $element->getUri() }} </td>
                                    <td>{{ $element->getPageStatusCode() }} </td>
                                    <td>{{ $element->getRequestTime() }}</td>
                                    <td>{{ $element->getInternalLinkCount() }}</td>
                                    <td>{{ $element->getExternalLinkCount() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <hr>
               Unique Images:         {{$numberOfUniqueImages}}
                        <hr>
                      Number of Internal Links Scanned:  {{$numberOfInternalLinks}}
                        <hr>
                        Number of External Links Scanned:   {{$numberOfExternalLinks}}
                        <hr>
                        Average Per Page Word Count: {{$averagePerPageWordCount}}
                        <hr>
                        <table class="table-auto">
                            <thead>
                            <tr>
                                <th class="px-4 py-2">Tag Type</th>
                                <th class="px-4 py-2">Average Heading Line Length </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($averageHeadingLength as $tagType =>  $count)
                                <tr>
                                    <td>{{$tagType }} </td>
                                    <td>{{ $count }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
