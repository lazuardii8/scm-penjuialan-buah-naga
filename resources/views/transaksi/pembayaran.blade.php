<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
	<title>Dragon Shop - Pembayaran</title>
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}">
	<link rel="stylesheet" href="{{ asset('css/lightbox.css') }}">

	@yield('style')
</head>
<body>

	<div class="pembayaran-content-baru">
		<div class="bagi-satu">
			<div class="grup-navigasi-pembayaran">
				<ul>
					<li><a href="/">Home</a></li>
					<li><a href="/pesanan">Pesanan</a></li>
					<li><a href="/transaksi-pembayaran">Transaksi</a></li>
					<li><a href="/history">History</a></li>
				</ul>
			</div>
			<div class="grup-one">
				<h1>Bayar Produk</h1>
				<h3 style="margin-bottom: 0">3432-5656-3434-5556</h3>
				<h4 style="margin-top:0">Atas Nama Joko</h4>
				<p>Total Pembayaran</p>
				@if (empty($transaksi->totalBayar))
				<p>Rp 0,-</p>
				@else
				<p>Rp {{number_format($transaksi->totalBayar)}},-</p>
				@endif
			</div>
		</div>
		<div class="bagi-dua">
			<div class="grup-head-title-pesanan">
				<h1><a href="/">Dragon Shop</a></h1>
			</div>
			<div class="grup-two">
				@if (!empty($transaksi->totalBayar))
                <h3>Upload Bukti Pembayaran</h3>
                <form action="/pembayaran/upload" method="POST" enctype="multipart/form-data" id="formbayar-style">
                    <div class="form-group">
                        <label for="email">No Rekening</label>
                        <input type="text" class="form-control" id="credit-card" name="norekening" placeholder="xxxx-xxxx-xxxx-xxxx" id="email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Upload Bukti</label>
                        <input type="file" class="form-control" placeholder="image.jpg" name="image" id="pwd">
                    </div>
                    {{ csrf_field() }}
                    <button type="submit">Upload</button>
                </form>
                @else
                <div class="grup-tidakada-pembayaran">
                    <h3 style="margin: 0;">Tidak ada Transaksi Pembayaran</h3>
                </div>
                @endif
            </div>
        </div>
    </div>


    <footer style="
    margin-top: -7px;
    ">
    <div class="col-xs-6">Copyright © Sekarang(2019)</div>
    <div class="col-xs-6">Salam Damai To SCM</div>
</footer>

<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/tinymcescript.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/lightbox.js') }}" type="text/javascript"></script>
<script type="text/javascript">
// 	$('.creditCardText').keyup(function() {
//   var foo = $(this).val().split("-").join(""); // remove hyphens
//   if (foo.length > 0) {
//   	foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
//   }
//   $(this).val(foo);
// });

input_credit_card = function(input)
{
	var format_and_pos = function(char, backspace)
	{
		var start = 0;
		var end = 0;
		var pos = 0;
		var separator = "-";
		var value = input.value;

		if (char !== false)
		{
			start = input.selectionStart;
			end = input.selectionEnd;

            if (backspace && start > 0) // handle backspace onkeydown
            {
            	start--;

            	if (value[start] == separator)
            		{ start--; }
            }
            // To be able to replace the selection if there is one
            value = value.substring(0, start) + char + value.substring(end);

            pos = start + char.length; // caret position
        }

        var d = 0; // digit count
        var dd = 0; // total
        var gi = 0; // group index
        var newV = "";
        var groups = /^\D*3[47]/.test(value) ? // check for American Express
        [4, 6, 5] : [4, 4, 4, 4];

        for (var i = 0; i < value.length; i++)
        {
        	if (/\D/.test(value[i]))
        	{
        		if (start > i)
        			{ pos--; }
        	}
        	else
        	{
        		if (d === groups[gi])
        		{
        			newV += separator;
        			d = 0;
        			gi++;

        			if (start >= i)
        				{ pos++; }
        		}
        		newV += value[i];
        		d++;
        		dd++;
        	}
            if (d === groups[gi] && groups.length === gi + 1) // max length
            	{ break; }
        }
        input.value = newV;

        if (char !== false)
        	{ input.setSelectionRange(pos, pos); }
    };

    input.addEventListener('keypress', function(e)
    {
    	var code = e.charCode || e.keyCode || e.which;

        // Check for tab and arrow keys (needed in Firefox)
        if (code !== 9 && (code < 37 || code > 40) &&
        // and CTRL+C / CTRL+V
        !(e.ctrlKey && (code === 99 || code === 118)))
        {
        	e.preventDefault();

        	var char = String.fromCharCode(code);

            // if the character is non-digit
            // OR
            // if the value already contains 15/16 digits and there is no selection
            // -> return false (the character is not inserted)

            if (/\D/.test(char) || (this.selectionStart === this.selectionEnd &&
            	this.value.replace(/\D/g, '').length >=
            (/^\D*3[47]/.test(this.value) ? 15 : 16))) // 15 digits if Amex
            {
            	return false;
            }
            format_and_pos(char);
        }
    });
    
    // backspace doesn't fire the keypress event
    input.addEventListener('keydown', function(e)
    {
        if (e.keyCode === 8 || e.keyCode === 46) // backspace or delete
        {
        	e.preventDefault();
        	format_and_pos('', this.selectionStart === this.selectionEnd);
        }
    });
    
    input.addEventListener('paste', function()
    {
        // A timeout is needed to get the new value pasted
        setTimeout(function(){ format_and_pos(''); }, 50);
    });
    
    input.addEventListener('blur', function()
    {
    	// reformat onblur just in case (optional)
    	format_and_pos(this, false);
    });
};

input_credit_card(document.getElementById('credit-card'));
</script>
<script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>
</body>
</html>
