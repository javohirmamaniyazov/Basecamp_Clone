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
                                    style="height: 50px; width: 90%; ">
                                    <option value="">Select Admin User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ $user->id == $project->admin_user_id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button type="submit" class="btn-md m-1 p-3 border rounded"
                                        style="background-color: #1E90FF; height: 53px; color: white">+Add
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
                                            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                        
                                            $filePath = 'storage/uploads/' . $attachment->file_path;
                                            $url = url($filePath);
                                        @endphp
                        
                                        @if (in_array($extension, $imageExtensions))
                                            <img src="{{ $url }}" alt="Attachment" style="width: 135px; height:130px">
                                        @else
                                            <img src="https://www.computerhope.com/jargon/t/text-file.png"
                                                alt="Default File Image" style="width: 135px; height:130px">
                                        @endif
                                    </div>
                        
                                    @if ($attachment->user_id === auth()->user()->id)
                                        <form action="{{ route('attachments.destroy', $attachment->id) }}"
                                            method="POST" class="ml-4">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                style="padding:5px; border: 1px solid rgb(255, 55, 0); border-radius: 10px; width: 120px; background-color: #ff1e31; margin: 5px;">Delete</button>
                                        </form>
                                    @endif
                        
                                    <div class="flex items-center">
                                        <span class="text-gray-500 dark:text-gray-300 ml-2">
                                            {{ $attachment->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </li>
                            @empty
                                <li class="py-2">No attachments yet.</li>
                            @endforelse
                        </ul>


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
