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
            try {
                try {
                    processing.innerHTML = `
                        ${start + 1} -
                        ${products[position].id}
                    `;

                    await fetch('/up-product?id=' + products[position].id, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': `{{ csrf_token() }}`,
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify(products[position]),
                    });

                    percent.innerHTML = (100 * position / products.length).toFixed(1) + ' %';
                } catch (error) {
                    failed[position] = position;
                    localStorage.setItem('failed', JSON.stringify(failed));

                    let el = document.getElementById('failed_el');
                    el.insertAdjacentHTML('afterbegin', `<div>${position}-${products[position].p_name}</div>`)
                    // console.log(error);
                }

                start = start + 1;
                localStorage.setItem('product_si', start);

                // uploaded[products[position].id] = products[position].id;
                // localStorage.setItem('uploaded',JSON.stringify(uploaded));

                await up_p(start)
            } catch (error) {

            }
        }
        async function get_p() {
            let res = await fetch('/arogga/products.json');
            let data = await res.json();
            products = data;
            products.sort((a, b) => a.id - b.id);

            const uniqueIds = [...new Set(products.map(obj => obj.id))];
            console.log(uniqueIds.length);

            await up_p(start);
        }
        get_p();
    </script>
</body>

</html>
