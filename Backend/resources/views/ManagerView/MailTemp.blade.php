<body>
    <fieldset>
        Hello sir,<br>
        Online Pharmacy Ltd has placed an order. <br>
        Manager ID: {{$id}} <br>

        Ordered Items: <br>
        @foreach ($order as $val)
            {{$val->med_name}} <br>
        @endforeach
         
        Thank You!
    </fieldset>
</body>