
<div class="form-group mb-3 {{@$input["parent"]["class"] ?? ''}}" {{@$input["parent"]["id"] ? "id='".@$input["parent"]["id"]."'" : ''}}>
    <label for="name" class="{{@$input["label"]["class"]}}">{{@$input["label"]["text"] ?? ucwords(@$input["name"])}}</label>
    <select
        {{@$input["ID"] ? "id='".@$input["ID"]."'" : ''}}
        class="form-control {{@$input["class"] ?? ''}}"
        name="{{@$input["name"]}}"
           {{isset($value) ? "value=$value" : ''}}
           required="required">
        @if(@$input["static"] == "dynamic")
            @foreach($dynamic_options[$input["dynamic_option"]] as $option)

        <option value="{{$option['id']}}">{{$option['title']}}</option>
            @endforeach
            @endif
    </select>
</div>
