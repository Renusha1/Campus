<?php
session_start();
if (!isset($_SESSION["name"])) {
    header("Location: StudentLogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Fee Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Khalti JS SDK -->
    <script src="https://khalti.com/static/khalti-checkout.js"></script>
</head>

<body class="bg-gradient-to-br from-blue-100 to-purple-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-lg w-full bg-white rounded-2xl shadow-2xl p-8 space-y-6">
        <h2 class="text-3xl font-bold text-center text-gray-800">Pay College Fees</h2>
        <p class="text-center text-gray-600">Welcome, <span
                class="font-semibold text-blue-600"><?= htmlspecialchars($_SESSION["name"]) ?></span></p>
        <p class="text-center text-lg text-gray-700">Your Current Balance: <strong>$500</strong></p>

        <!-- Gateway selection -->
        <div class="flex justify-center space-x-8 mb-4">
            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="radio" name="gateway" value="esewa" checked class="form-radio text-green-600">
                <img src="https://upload.wikimedia.org/wikipedia/commons/8/8d/Esewa_Logo.png" alt="eSewa" class="h-6">
            </label>
            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="radio" name="gateway" value="khalti" class="form-radio text-purple-600">
                <img src="https://seeklogo.com/images/K/khalti-wallet-logo-FA4A24E3A3-seeklogo.com.png" alt="Khalti"
                    class="h-6">
            </label>
        </div>

        <!-- eSewa Form -->
        <form id="esewaForm" action="https://uat.esewa.com.np/epay/main" method="POST" class="space-y-4">
            <input name="amt" value="500" type="hidden">
            <input name="psc" value="0" type="hidden">
            <input name="pdc" value="0" type="hidden">
            <input name="txAmt" value="0" type="hidden">
            <input name="tAmt" value="500" type="hidden">
            <input name="pid" value="ORDER12345" type="hidden">
            <input name="su" value="https://your-domain.com/esewa_success.php" type="hidden">
            <input name="fu" value="https://your-domain.com/esewa_failure.php" type="hidden">

            <div>
                <label class="block text-gray-700 font-medium mb-1">Amount to Pay (in NPR)</label>
                <input id="esewaAmount" name="amt" type="number" value="500" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded-lg transition">
                Pay via eSewa
            </button>
        </form>

        <!-- Khalti Button -->
        <div id="khaltiButton" class="hidden">
            <button id="checkoutButton"
                class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 rounded-lg transition">
                Pay via Khalti
            </button>
        </div>
    </div>

    <script>
        // Toggle payment options
        const esewaForm = document.getElementById('esewaForm');
        const khaltiDiv = document.getElementById('khaltiButton');

        document.querySelectorAll('input[name="gateway"]').forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.value === 'khalti' && radio.checked) {
                    esewaForm.classList.add('hidden');
                    khaltiDiv.classList.remove('hidden');
                } else {
                    esewaForm.classList.remove('hidden');
                    khaltiDiv.classList.add('hidden');
                }
            });
        });

        // Khalti Configuration
        const khaltiConfig = {
            publicKey: 'test_public_key_yourkeyhere', // replace with your public key
            productIdentity: 'ORDER12345',
            productName: 'College Fee',
            productUrl: 'https://your-domain.com/fee_payment.php',
            eventHandler: {
                onSuccess(payload) {
                    window.location.href = `khalti_success.php?token=${payload.token}&amount=${payload.amount}`;
                },
                onError(error) {
                    console.error(error);
                    alert('Khalti payment failed. Please try again.');
                },
                onClose() {
                    console.log('Khalti widget closed.');
                }
            },
            paymentPreference: [
                'KHALTI', 'EBANKING', 'MOBILE_BANKING', 'CONNECT_IPS', 'SCT'
            ]
        };

        const khaltiCheckout = new KhaltiCheckout(khaltiConfig);
        document.getElementById('checkoutButton').addEventListener('click', () => {
            const amt = parseInt(document.getElementById('esewaAmount').value, 10) * 100;
            khaltiConfig.amount = amt;
            khaltiCheckout.show({ amount: amt });
        });
    </script>
</body>

</html>