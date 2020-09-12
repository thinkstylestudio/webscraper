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
