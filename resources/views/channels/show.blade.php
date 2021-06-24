@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ $channel->name }}
                    <a href="{{ route('channel.upload', $channel->id) }}">Upload Video</a>
                </div>

                <div class="card-body">
                    @if ( $channel->editable() )
                        <form id="update-channel-form" action="{{ route('channels.update', $channel->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                    @endif
                        <div class="form-group row justify-content-center">
                            <div class="channel-avatar">
                                @if($channel->editable())
                                <div onclick="document.getElementById('image').click()" class="channel-avatar-overlay">
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            width="906px" height="906px" viewBox="0 0 906 906" style="enable-background:new 0 0 906 906;" xml:space="preserve">
                                        <g>
                                            <path d="M251.79,0c-13.975,0-23.641,13.967-18.717,27.046l69.353,184.234c12.632-7.878,25.889-14.781,39.731-20.637
                                                c35.121-14.855,72.414-22.387,110.843-22.387s75.722,7.532,110.843,22.387c13.715,5.801,26.854,12.631,39.379,20.418
                                                l71.577-183.803C679.905,14.146,670.234,0,656.163,0H251.79z"/>
                                            <path d="M878.742,231.201l-183.803,71.577c7.786,12.527,14.616,25.665,20.418,39.379c14.854,35.121,22.387,72.414,22.387,110.843
                                                s-7.532,75.722-22.387,110.843c-5.855,13.843-12.76,27.1-20.638,39.731l184.234,69.354C892.033,677.851,906,668.185,906,654.21
                                                V249.837C906,235.766,891.854,226.095,878.742,231.201z"/>
                                            <path d="M563.843,715.357c-35.121,14.854-72.414,22.387-110.843,22.387s-75.722-7.532-110.843-22.387
                                                c-13.715-5.802-26.854-12.632-39.379-20.418l-71.577,183.803C226.095,891.854,235.766,906,249.837,906H654.21
                                                c13.975,0,23.641-13.967,18.717-27.046L603.574,694.72C590.942,702.598,577.686,709.502,563.843,715.357z"/>
                                            <path d="M27.258,674.799l183.803-71.577c-7.787-12.526-14.617-25.665-20.418-39.379c-14.854-35.121-22.387-72.414-22.387-110.843
                                                s7.532-75.722,22.387-110.843c5.855-13.843,12.759-27.099,20.637-39.731L27.046,233.073C13.967,228.149,0,237.815,0,251.79v404.372
                                                C0,670.234,14.146,679.906,27.258,674.799z"/>
                                            <path d="M712.744,453c0-42.3-10.119-82.234-28.057-117.526c-24.956-49.101-65.061-89.204-114.161-114.161
                                                C535.234,203.375,495.3,193.256,453,193.256s-82.234,10.119-117.526,28.057c-49.101,24.957-89.205,65.06-114.161,114.161
                                                C203.375,370.766,193.256,410.7,193.256,453s10.119,82.234,28.057,117.526c24.957,49.101,65.06,89.204,114.161,114.161
                                                C370.766,702.625,410.7,712.744,453,712.744s82.234-10.119,117.526-28.057c49.101-24.957,89.205-65.061,114.161-114.161
                                                C702.625,535.234,712.744,495.3,712.744,453z M453,589c-75.111,0-136-60.889-136-136s60.889-136,136-136s136,60.889,136,136
                                                S528.111,589,453,589z"/>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                    </svg>
                                </div>
                                @endif
                                <img style="width: 100px; height: 100px;" src="{{ $channel->image() }}" alt="">
                            </div>
                        </div>

                        <div class="form-group">
                            <h4 class="text-center">
                                {{ $channel->name }}
                            </h4>
                            <p class="text-center">
                                {{ $channel->description }}
                            </p>
                            <div class="text-center">
                                <subscribe-button :channel="{{ $channel }}" :initial-subscriptions="{{ $channel->subscriptions }}"></subscribe-button>
                            </div>
                        </div>

                        @if($channel->editable())
                        <input onchange="document.getElementById('update-channel-form').submit()" style="display: none;"  id="image" type="file" name="image">

                        <div class="form-group">
                            <label for="name" class="form-control-label">
                                Name
                            </label>
                            <input id="name" name="name" value="{{ $channel->name }}" type="text" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-control-label">
                                Description
                            </label>
                            <textarea name="description" id="description" rows="3" class="form-control">{{ $channel->description }}</textarea>
                        </div>

                        @if($errors->any())
                            <ul class="list-group mb-5">
                                @foreach($errors->all() as $error)
                                    <li class="text-danger list-group-item">
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <button type="submit" class="btn btn-info">
                            Update Channel
                        </button>
                         @endif
                    @if($channel->editable())
                        </form>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Videos
                </div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Views</th>
                            <th>Status</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($videos as $video)
                                <tr>
                                    <td>
                                        <img width="40px" height="40px" src="{{ $video->thumbnail }}" alt="">
                                    </td>
                                    <td>
                                        {{ $video->title }}
                                    </td>
                                    <td>
                                        {{ $video->views }}
                                    </td>
                                    <td>
                                        {{ $video->percentage === 100 ? 'Live' : 'Processing' }}
                                    </td>
                                    <td>
                                        @if($video->percentage === 100)
                                            <a href="{{ route('videos.show', $video->id) }}" class="btn btn-sm btn-info">
                                                View
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row justify-content-center">
                        {{ $videos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
