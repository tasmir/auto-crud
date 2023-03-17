
<div class="form-group mb-3 {{$input["parent"]["class"] ?? ''}}" {{$input["parent"]["id"] ? "id='".$input["parent"]["id"]."'" : ''}}>
    <label for="name" class="{{$input["label"]["class"]}}">{{$input["label"]["text"] ?? ucwords($input["type"])}}</label>
    <input {{$input["ID"] ? "id='".$input["ID"]."'" : ''}} class="form-control {{$input["class"] ?? ''}}" name="{{$input["name"]}}" type="{{$input["type"]}}"
           placeholder=""
           {{isset($value) ? "value=$value" : ''}}
           required="required">
</div>
