<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Add React in One Minute</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>

<h2>Add React in One Minute</h2>
<p>This page demonstrates using React with no build tooling.</p>
<p>React is loaded as a script tag.</p>

<!-- We will put our React component inside this div. -->
<div id="like_button_container"></div>

<!-- Load React. -->
<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
<!-- Note: when deploying, replace "development.js" with "production.min.js". -->
{{--<script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>--}}
{{--<script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>--}}

<script src="https://unpkg.com/react@18/umd/react.production.min.js" crossorigin></script>
<script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js" crossorigin></script>

<!-- Load our React component. -->
<script type="text/babel" src="{{asset("components/like_button.jsx")}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
