<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<table>
    <tr>
        <th>Name</th>
        <th>Number 1</th>
        <th>Number 2</th>
        <th>Total</th>
    </tr>
    @foreach($data as $student)
        <tr>
            <th>{{$student->name}}</th>
            <th><input data-row="{{$loop->iteration}}" id="number{{$loop->iteration}}1" type="text" value="{{$student->number1}}"></th>
            <th><input data-row="{{$loop->iteration}}" id="number{{$loop->iteration}}2" type="text" value="{{$student->number2}}"></th>
            <th>Total <span id="result{{$loop->iteration}}">{{$student->number1+$student->number2}}</span></th>
        </tr>
    @endforeach
    <tr>
        <th>Name</th>
        <th>Number 1</th>
        <th>Number 2</th>
        <th>Total</th>
    </tr>

</table>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script>
    $('input').keyup(function () {
        console.log($(this).attr('data-row'))
        let rowNumber=$(this).attr('data-row')
        let rowSum = 0
        for (let i = 0; i < 4; i++) {
        let value= parseInt($`#number${rowNumber}${i}`.val())
            rowSum += value;
        }
        isNaN(rowSum) ? (`#result${rowNumber}`).text(0):$(`#result${rowNumber}`).text(rowSum);
    })
</script>
</body>
</html>
