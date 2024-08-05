<!DOCTYPE html>
<html>

<table border="1">
    <tr>
        <td>id</td>
        <td>title</td>
        <td>icon</td>
        <td>icon_gray</td>
    </tr>
    @foreach($parameters as $parameter)
        <tr>
            <td>
                {{$parameter['id']}}
            </td>
            <td>
                {{$parameter['title']}}
            </td>
            @if($parameter['type'] == 2)
                @foreach(['icon','icon_gray'] as $icon_type)
                    <td>
                        @if(!empty($parameter[$icon_type]))
                            <div style="width: 350px; height: 100px; display: flex;">
                                <img height="100px" width="100px" src="{{asset($parameter[$icon_type])}}" alt="">
                                <div style="width: 250px; display:flex; flex-direction: column">
                                    <form action="{{route('delete_image')}}" method="post">
                                        @csrf
                                        <input hidden type="number" name="parameter_id" value="{{$parameter['id']}}">
                                        <input hidden type="text" name="type" value="{{$icon_type}}">
                                        <button style="width:250px">
                                            Удалить
                                        </button>
                                    </form>
                                    <br>
                                    <form action="{{route('upload_image')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input hidden type="text" name="parameter_id" value="{{$parameter['id']}}">
                                        <input hidden type="text" name="type" value="{{$icon_type}}">
                                        <input type="file" name="image">
                                        <input type="submit" value="Заменить картинку">
                                    </form>
                                </div>
                            </div>
                        @else
                            <form action="{{route('upload_image')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                {{$parameter['id']}}
                                <input hidden type="text" name="parameter_id" value="{{$parameter['id']}}">
                                <input hidden type="text" name="type" value="{{$icon_type}}">
                                <input type="file" name="image" id="">
                                <input type="submit" value="Отправить">
                            </form>
                        @endif
                    </td>
                @endforeach
            @else
                <td></td>
                <td></td>
            @endif
        </tr>
    @endforeach
</table>
@csrf
</html>
