
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

        // Map keys to human-readable titles
        const keyTitles = {
            A: "Invoice ID",
            B: "Client ID",
            C: "Country",
            D: "Document Type",
            E: "Series Code",
            F: "Date",
            G: "Invoice Number",
            H: "Customer NIF or Reference",
            I1: "Country of Tax",
            I7: "Taxable Amount",
            I8: "VAT Amount",
            N: "Net VAT Amount",
            O: "Total Amount (including VAT)",
            Q: "Reference Code",
            R: "Additional Reference Number"
        };

        // Build the HTML structure with both key and title
        let displayData = "<h2>Invoice Details</h2><div>";
        for (const key in parsedData) {
            const title = keyTitles[key] || `Unknown (${key})`;
            displayData += `<div><strong>${key} (${title}):</strong> ${parsedData[key]}</div>`;
        }
        displayData += "</div>";

        document.getElementById('result').innerHTML = displayData;

        scanner.clear();
        document.getElementById('reader').remove();
    }

    function error(err) {
        console.error(err);
    }
</script>


</body>
    
