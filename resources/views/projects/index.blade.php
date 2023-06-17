<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-1">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold">
                        Project Index - {{ $project->name }}
                    </h2>
                    <hr class="my-4 border-gray-300 dark:border-gray-700" />

                    <div class="mt-4">
                        <h3 class="text-lg font-semibold">Name: {{ $project->name }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">Description: {{ $project->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($project->user_id === auth()->user()->id)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('projects.update', $project->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="admin_user_id" class="text-lg font-semibold" style="margin-bottom: 10px;">Assign
                                Admin:</label>
                            <div class="input-group flex">
                                <select name="admin_user_id" id="admin_user_id" class="form-control m-3"
                                    style="height: 50px; width: 90%; color: black;">
                                    <option value="">Select Admin User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ $user->id == $project->admin_user_id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button type="submit" class="btn-md  mt-3 border rounded"
                                        style="background-color: #1E90FF; height: 52px; color: white;">+Add
                                        admin</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endif

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mt-3">
                        <h3 class="text-lg font-semibold" style="margin-bottom: 10px;">Create Attachment
                        </h3>
                        <form action="{{ route('attachments.store', $project) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" class="mb-4" name="file"><br>
                            <button type="submit"
                                style="padding:5px; border: 1px solid blue; border-radius: 10px; background-color: #1E90FF; margin-bottom: 20px;">Upload</button>
                        </form>
                        <h3 class="text-lg font-semibold">Attachments:</h3>
                        <ul class="mt-4 flex">
                            @forelse ($project->attachments as $attachment)
                                <li class="py-2">
                                    <div>
                                        @php
                                            $extension = strtolower(pathinfo($attachment->file_path, PATHINFO_EXTENSION));
                                        @endphp
                        
                                        @if ($extension)
                                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIIAAACCCAMAAAC93eDPAAAAYFBMVEX///8AAAAYGBgICAjc3NxwcHDn5+dkZGRpaWnw8PAcHBxtbW14eHgsLCynp6fX19dYWFizs7OcnJy6urpMTExSUlLDw8M3NzdGRkY9PT34+PhdXV0jIyMRERGVlZWFhYWb1tEdAAACg0lEQVR4nO2ba5eCIBBAtUxh89FDrayt//8v10TZTdBkZuwc98z9yqNbDDGgeB7DMEuhCgMQIZVAGH/7QJJ7RWEQXKACT84SbyATjIHv53iHw7OfaAMhbxxOaIei7qWENU19Godb3QmwaUoUDyvfXyMUcoJ4QCocU/xYIBX2ajguGAe0gppTmLHAKygHREwSKHjIeKBQUA7g34FEQY1FAXSgUUDFA5ECZm5SKSgH0FiQKbTxAMhh6BSUw8XdgVChjQdnB0oF9TvsXB0QCvv682LTyjke/iqU8TBHs6lsvvNLrUeTieZghWA0T83Mtpuhunuz7jSF46hCaraV54G6EVTBy0cMbrY/neq+tlZOwAreyMZuIMSqIOsR1HuzFVyBhDUrsAIrsAIrUCuU8fYV0WYJ8iG2b9jooxqMgi1fUB1fR5fxloBAwZYvHJqSKQZ+l1dhFKqd0e1ZHbCmlk/sc+2Wc1QsVEaW0OUpE06IdUKx9BnBCqzACqzQVyjFNQJyFbOtlA7MtVI6QLFSehHGQG/oceEYItCdLH1GsAIrsAIr9BWO4u2CGLf/gmm/ROhDaoxCNmUpKJSspaQ7pMYolFMUVO+2HV6XMKAGwtxTmqhDdnkyCnZdL7hwrOQ79M5xsGDxM4IVWIEVWKGvsBcI9OPR2VfKYT62Ug5DslKK1ReYleh6wYWjhG8pf58nL31GsAIrsAIrwBWqQ7Hrod/4+ZDCXHtKB2bbU05HRkkf/bbbx8KRT19ZgRVY4X8rIC4tDVB3eHNqgLi6Zee5LSycWiAusFlpHjQenBSw1/hsJI5XFDLUZUYbF8tb2+OEsf1lZiDrGHLZFHqx1UZIcs+UYZiP8AMcKDKyoy0W+QAAAABJRU5ErkJggg==" alt="Attachment" style="width: 135px; height:130px; margin: 4px; border-radius: 10px;">
                                        @else
                                            <img src="https://www.computerhope.com/jargon/t/text-file.png" alt="Default File Image" style="width: 135px; height:130px">
                                        @endif
                                    </div>
                        
                                    <div class="flex mt-2" style="justify-content: space-around;">
                                        @if ($attachment->user_id === auth()->user()->id)
                                            <form action="{{ route('attachments.destroy', $attachment->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="margin-top:4px; padding-left:4px; border: 1px solid rgb(255, 55, 0); border-radius: 10px; width: 45px; background-color: #ff1e31; margin-right: 5px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 100 100" width="35" height="35px"><path fill="#f37e98" d="M25,30l3.645,47.383C28.845,79.988,31.017,82,33.63,82h32.74c2.613,0,4.785-2.012,4.985-4.617L75,30"/><path fill="#f15b6c" d="M65 38v35c0 1.65-1.35 3-3 3s-3-1.35-3-3V38c0-1.65 1.35-3 3-3S65 36.35 65 38zM53 38v35c0 1.65-1.35 3-3 3s-3-1.35-3-3V38c0-1.65 1.35-3 3-3S53 36.35 53 38zM41 38v35c0 1.65-1.35 3-3 3s-3-1.35-3-3V38c0-1.65 1.35-3 3-3S41 36.35 41 38zM77 24h-4l-1.835-3.058C70.442 19.737 69.14 19 67.735 19h-35.47c-1.405 0-2.707.737-3.43 1.942L27 24h-4c-1.657 0-3 1.343-3 3s1.343 3 3 3h54c1.657 0 3-1.343 3-3S78.657 24 77 24z"/><path fill="#1f212b" d="M66.37 83H33.63c-3.116 0-5.744-2.434-5.982-5.54l-3.645-47.383 1.994-.154 3.645 47.384C29.801 79.378 31.553 81 33.63 81H66.37c2.077 0 3.829-1.622 3.988-3.692l3.645-47.385 1.994.154-3.645 47.384C72.113 80.566 69.485 83 66.37 83zM56 20c-.552 0-1-.447-1-1v-3c0-.552-.449-1-1-1h-8c-.551 0-1 .448-1 1v3c0 .553-.448 1-1 1s-1-.447-1-1v-3c0-1.654 1.346-3 3-3h8c1.654 0 3 1.346 3 3v3C57 19.553 56.552 20 56 20z"/><path fill="#1f212b" d="M77,31H23c-2.206,0-4-1.794-4-4s1.794-4,4-4h3.434l1.543-2.572C28.875,18.931,30.518,18,32.265,18h35.471c1.747,0,3.389,0.931,4.287,2.428L73.566,23H77c2.206,0,4,1.794,4,4S79.206,31,77,31z M23,25c-1.103,0-2,0.897-2,2s0.897,2,2,2h54c1.103,0,2-0.897,2-2s-0.897-2-2-2h-4c-0.351,0-0.677-0.185-0.857-0.485l-1.835-3.058C69.769,20.559,68.783,20,67.735,20H32.265c-1.048,0-2.033,0.559-2.572,1.457l-1.835,3.058C27.677,24.815,27.351,25,27,25H23z"/><path fill="#1f212b" d="M61.5 25h-36c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h36c.276 0 .5.224.5.5S61.776 25 61.5 25zM73.5 25h-5c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h5c.276 0 .5.224.5.5S73.776 25 73.5 25zM66.5 25h-2c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h2c.276 0 .5.224.5.5S66.776 25 66.5 25zM50 76c-1.654 0-3-1.346-3-3V38c0-1.654 1.346-3 3-3s3 1.346 3 3v25.5c0 .276-.224.5-.5.5S52 63.776 52 63.5V38c0-1.103-.897-2-2-2s-2 .897-2 2v35c0 1.103.897 2 2 2s2-.897 2-2v-3.5c0-.276.224-.5.5-.5s.5.224.5.5V73C53 74.654 51.654 76 50 76zM62 76c-1.654 0-3-1.346-3-3V47.5c0-.276.224-.5.5-.5s.5.224.5.5V73c0 1.103.897 2 2 2s2-.897 2-2V38c0-1.103-.897-2-2-2s-2 .897-2 2v1.5c0 .276-.224.5-.5.5S59 39.776 59 39.5V38c0-1.654 1.346-3 3-3s3 1.346 3 3v35C65 74.654 63.654 76 62 76z"/><path fill="#1f212b" d="M59.5 45c-.276 0-.5-.224-.5-.5v-2c0-.276.224-.5.5-.5s.5.224.5.5v2C60 44.776 59.776 45 59.5 45zM38 76c-1.654 0-3-1.346-3-3V38c0-1.654 1.346-3 3-3s3 1.346 3 3v35C41 74.654 39.654 76 38 76zM38 36c-1.103 0-2 .897-2 2v35c0 1.103.897 2 2 2s2-.897 2-2V38C40 36.897 39.103 36 38 36z"/></svg>
                                                </button>
                                            </form>
                                        @endif
                        
                                        <a href="{{ route('attachments.download', $attachment->id) }}"  style="text-decoration: none; padding-left: 5px; height: 38px; margin-top: 4px; border: 1px solid blue; border-radius: 10px; width: 45px; margin-right: 5px; display:block;">
                                            <svg width="35px" height="35px" viewBox="0 0 1024 1024" class="icon"  version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M768 810.7c-23.6 0-42.7-19.1-42.7-42.7s19.1-42.7 42.7-42.7c94.1 0 170.7-76.6 170.7-170.7 0-89.6-70.1-164.3-159.5-170.1L754 383l-10.7-22.7c-42.2-89.3-133-147-231.3-147s-189.1 57.7-231.3 147L270 383l-25.1 1.6c-89.5 5.8-159.5 80.5-159.5 170.1 0 94.1 76.6 170.7 170.7 170.7 23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7c-141.2 0-256-114.8-256-256 0-126.1 92.5-232.5 214.7-252.4C274.8 195.7 388.9 128 512 128s237.2 67.7 297.3 174.2C931.5 322.1 1024 428.6 1024 554.7c0 141.1-114.8 256-256 256z" fill="#3688FF" /><path d="M512 938.7c-10.9 0-21.8-4.2-30.2-12.5l-128-128c-16.7-16.7-16.7-43.7 0-60.3 16.6-16.7 43.7-16.7 60.3 0l97.8 97.8 97.8-97.8c16.6-16.7 43.7-16.7 60.3 0 16.7 16.7 16.7 43.7 0 60.3l-128 128c-8.2 8.3-19.1 12.5-30 12.5z" fill="#5F6379" /><path d="M512 938.7c-23.6 0-42.7-19.1-42.7-42.7V597.3c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7V896c0 23.6-19.1 42.7-42.7 42.7z" fill="#5F6379" /></svg>
                                        </a>
                                    </div>
                                    <span class="text-gray-500 dark:text-gray-300 ml-2">
                                            <h3>{{ $attachment->created_at->diffForHumans() }}</h3>
                                    </span>
                                </li>
                            @empty
                                <li class="py-2">No attachments yet.</li>
                            @endforelse
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold">Comments</h2>
                    <hr class="my-4 border-gray-300 dark:border-gray-700" />

                    <div class="mt-4">
                        <form action="{{ url('projects', $project->id) }}/comments" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="content"
                                    class="block text-gray-700 dark:text-gray-400 font-bold mb-2">Comment:</label>
                                <textarea name="content" id="content" rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:text-gray-300"></textarea>
                            </div>
                            <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md "
                                style="border: 1px solid blue;margin-left: auto; background-color: #1E90FF; display: flex; justify-content: flex-end;">Submit</button>
                        </form>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-lg font-semibold">Existing Comments:</h3>
                        <ul class="mt-4">
                            @foreach ($project->comments as $comment)
                                <li class="mb-4">
                                    created by:<span class=" font-semibold" style="color: #ADD8E6">
                                        {{ $comment->user->name }}</span>
                                    <p class="mt-2 text-gray-600 dark:text-gray-400" style="margin-left: 20px;">
                                        {{ $comment->content }}</p>
                                    <div class="flex items-center">

                                        <div style="margin-left: auto; display: flex;">
                                            @if ($comment->user_id === auth()->user()->id)
                                                <form id="edit-form-{{ $comment->id }}"
                                                    action="{{ route('comments.update', $comment->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="flex">
                                                        <input name="content" value="{{ $comment->content }}"
                                                            rows="3"
                                                            class="px-2 py-3 p-3 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:text-gray-300">
                                                        <button type="submit"
                                                            class="bg-yellow-500 text-white px-4 py-2 rounded-md mr-2 hover:bg-yellow-700"
                                                            style="background-color: #ffc107!important; padding: 12px; margin-left: 5px;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-pen"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                                            </svg>
                                                        </button>
                                                        <button type="button" id="cancel-button-{{ $comment->id }}"
                                                            onclick="event.preventDefault(); cancelEdit('{{ $comment->id }}');"
                                                            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-700"
                                                            style="padding: 12px; margin-left: 5px;">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                version="1.1" width="17" height="17"
                                                                viewBox="0 0 256 256" xml:space="preserve">
                                                                <defs>
                                                                </defs>
                                                                <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                                                                    transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                                                    <path
                                                                        d="M 65.75 90 c 0.896 0 1.792 -0.342 2.475 -1.025 c 1.367 -1.366 1.367 -3.583 0 -4.949 L 29.2 45 L 68.225 5.975 c 1.367 -1.367 1.367 -3.583 0 -4.95 c -1.367 -1.366 -3.583 -1.366 -4.95 0 l -41.5 41.5 c -1.367 1.366 -1.367 3.583 0 4.949 l 41.5 41.5 C 63.958 89.658 64.854 90 65.75 90 z"
                                                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                                        transform=" matrix(1 0 0 1 0 0) "
                                                                        stroke-linecap="round" />
                                                                </g>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </form>
                                                <button type="button" id="edit-button-{{ $comment->id }}"
                                                    onclick="event.preventDefault(); editComment('{{ $comment->id }}');"
                                                    class="text-white rounded-md ml-2"
                                                    style="background-color: #ffc107!important; padding: 12px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-pen"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                                    </svg>
                                                </button>
                                                <form action="{{ route('comments.destroy', $comment->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-500 text-white px-3 py-3 rounded-md ml-2 hover:bg-red-700"
                                                        style="padding: 12px;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                            height="17" fill="currentColor" class="bi bi-trash"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                            <path
                                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

















    <script>
        function editComment(commentId) {
            document.getElementById('edit-form-' + commentId).style.display = 'block';
            document.getElementById('edit-button-' + commentId).style.display = 'none';
            document.getElementById('cancel-button-' + commentId).style.display = 'inline-block';
        }

        function cancelEdit(commentId) {
            document.getElementById('edit-form-' + commentId).style.display = 'none';
            document.getElementById('edit-button-' + commentId).style.display = 'inline-block';
            document.getElementById('cancel-button-' + commentId).style.display = 'none';
        }
    </script>
</x-app-layout>
