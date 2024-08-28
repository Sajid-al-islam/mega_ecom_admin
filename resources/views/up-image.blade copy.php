<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: rgb(21, 21, 21);
            color: #5cb5aa;
            height: 100vh;
            display: grid;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div>
        <h3 style="margin: auto; margin-bottom: 50px; height: 80px; text-align: center; line-height: 80px; width: 80px; border: 1px solid red; border-radius: 50%;"
            id="percent">0%</h3>
        <div style="display: flex; gap: 20px; max-width: 600px;">
            <div id="processing" style="width: 200px;">
                loading..
            </div>
            <div id="failed_el" style="max-height: 300px; overflow-y:auto;width: 200px;">

            </div>
        </div>
    </div>
    <script>
        var start = localStorage.getItem('product_si') ? parseInt(localStorage.getItem('product_si')) : 0;
        let products = [];
        let uploaded = localStorage.getItem('uploaded') ? JSON.parse(localStorage.getItem('uploaded')) : {};
        let failed = localStorage.getItem('failed') ? JSON.parse(localStorage.getItem('failed')) : {};

        async function up_p(position) {
            let is_error = 0;
            try {
                processing.innerHTML = `
                    ${start + 1} / 16085
                `;

                if (start <= 16085) {
                    let res = await fetch(`/up-product?si=${start}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': `{{ csrf_token() }}`,
                            "Content-Type": "application/json",
                        },
                        // body: JSON.stringify(products[position]),
                    });

                    let status = res.status;
                    let data = await res.text();

                    if (status != 200) {
                        is_error = 1;
                    }
                }

                percent.innerHTML = (100 * position / 16085).toFixed(1) + ' %';
            } catch (error) {
                throw error;
            }

            if (!is_error) {
                start = start + 1;
                localStorage.setItem('product_si', start);
                await up_p(start)
            }

        }

        up_p();
    </script>
</body>

</html>
