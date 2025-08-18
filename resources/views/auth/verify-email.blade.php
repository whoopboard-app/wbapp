<x-guest-layout>
     <div class="mb-4 text-sm text-gray-600">
        {{ __('Please enter the 6-digit verification code sent to your email address.') }}
    </div>

    <div 
        x-data="countdownTimer({{ $expiresAt }})" 
        x-init="startTimer()" 
        class="my-2 text-sm text-gray-600"
    >
        Code expires in: 
        <span class="font-semibold text-red-600" x-text="timeLeft"></span>
    </div>


    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new code has been sent to the email address you provided during registration.') }}
        </div>
    @endif
        <form method="POST" action="{{ route('verify.code') }}">
            @csrf
            <div>
                <label for="code" class="block font-medium text-sm text-gray-700">Verification Code</label>
               <div class="flex justify-between gap-3 mt-4">
                    @for ($i = 0; $i < 6; $i++)
                        <input type="text" maxlength="1" inputmode="numeric" pattern="\d*"
                            required
                            class="w-12 h-12 text-center border border-gray-300 rounded-lg text-lg font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500 otp-input">
                    @endfor
                </div>

                <input type="hidden" id="code" name="code" maxlength="6" required pattern="\d{6}">

                @error('code')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            <div>
                <button type="submit"
                    class="w-full bg-blue-700 hover:bg-blue-500 text-white font-semibold py-3 rounded-lg shadow-md transition duration-200 mt-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    {{ __('Verify Code') }}
                </button>
            </div>
        </form>
        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-primary-button>
                        {{ __('Resend Verification Email') }}
                    </x-primary-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
        <script>
            function countdownTimer(expiryTimestamp) {
                return {
                    timeLeft: '',
                    startTimer() {
                        const expiresAt = expiryTimestamp * 1000;

                        const update = () => {
                            const now = new Date().getTime();
                            const distance = expiresAt - now;

                            if (distance <= 0) {
                                this.timeLeft = 'Expired';
                                return;
                            }

                            const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
                            const minutes = Math.floor((distance / (1000 * 60)) % 60);
                            const seconds = Math.floor((distance / 1000) % 60);

                            this.timeLeft = `${hours}h ${minutes}m ${seconds}s`;
                        };

                        update();
                        setInterval(update, 1000);
                    }
                };
            }
        </script>

  <script>
document.addEventListener("DOMContentLoaded", function () {
    const inputs = document.querySelectorAll(".otp-input");
    const hiddenInput = document.getElementById("code");

    inputs.forEach((input, index) => {
        input.addEventListener("input", function (e) {
            const value = this.value.replace(/\D/g, ""); // Remove non-digits
            this.value = value;

            if (value && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }

            updateHidden();
        });

        input.addEventListener("keydown", function (e) {
            if (e.key === "Backspace" && this.value === "" && index > 0) {
                inputs[index - 1].focus();
            }
        });

        input.addEventListener("paste", function (e) {
            e.preventDefault();
            const pasteData = (e.clipboardData || window.clipboardData).getData("text").replace(/\D/g, "");
            pasteData.split("").forEach((char, i) => {
                if (inputs[i]) inputs[i].value = char;
            });
            updateHidden();
        });
    });

    function updateHidden() {
        hiddenInput.value = Array.from(inputs).map(i => i.value).join("");
    }
});
</script>
</x-guest-layout>
