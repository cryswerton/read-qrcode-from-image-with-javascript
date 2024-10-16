
<head>
    <style>
        main {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #reader {
            width: 600px;
        }
        #result {
            text-align: center;
            font-size: 1.5rem;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
</head>
<body>
    <main>
        <div id="reader"></div>
        <div id="result"></div>
    </main>
    <script>
    const scanner = new Html5QrcodeScanner('reader', { 
        qrbox: {
            width: 250,
            height: 250,
        },
        fps: 20,
    });

    scanner.render(success, error);

    function success(result) {
        console.log(result);

        // Split the result into key-value pairs
        const parsedData = {};
        result.split('*').forEach(pair => {
            const [key, value] = pair.split(':');
            parsedData[key] = value;
        });

        // Build the HTML structure
        const displayData = `
            <h2>Invoice Details</h2>
            <p><strong>Invoice ID:</strong> ${parsedData['A']}</p>
            <p><strong>Client ID:</strong> ${parsedData['B']}</p>
            <p><strong>Country:</strong> ${parsedData['C']}</p>
            <p><strong>Document Type:</strong> ${parsedData['D']}</p>
            <p><strong>Date:</strong> ${parsedData['F']}</p>
            <p><strong>Invoice Number:</strong> ${parsedData['G']}</p>
            <p><strong>Taxable Amount:</strong> ${parsedData['I7']} EUR</p>
            <p><strong>VAT Amount:</strong> ${parsedData['I8']} EUR</p>
            <p><strong>Net VAT:</strong> ${parsedData['N']} EUR</p>
            <p><strong>Total Amount (including VAT):</strong> ${parsedData['O']} EUR</p>
            <p><strong>Reference Code:</strong> ${parsedData['Q']}</p>
        `;

        document.getElementById('result').innerHTML = displayData;

        scanner.clear();
        document.getElementById('reader').remove();
    }

    function error(err) {
        console.error(err);
    }
</script>
</body>
    
