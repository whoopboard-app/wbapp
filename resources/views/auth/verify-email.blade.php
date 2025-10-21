<x-guest-layout>
    @if ($errors->any())
        <x-alert type="error" :message="$errors->first()" />
    @endif

    <div class="container py-0 mb-4">
        <div class="card p-0 bg-white">
            <div class="border-title">
                <h2 class="text-xl fw-bold text-gray-800 mt-6 mb-2 flex items-center gap-2 tracking-tight">
                <span>🔐</span>
                    Verify your identity (code is {{ $user->verify_code  }})
                </h2>
            </div>
            <div class="content-body">
                
                <p class="mb-0 color-support fw-semibold form-para">
                    We’ve sent a one-time passcode (OTP) to your registered email address [email@domain.com]. Enter it below to continue.
                </p>
                <div
                    x-data="countdownTimer({{ $expiresAt }})"
                    x-init="startTimer()"
                    class="my-2 text-sm text-gray-600"
                >
                    Code expires in:
                    <span class="font-semibold text-red-600" x-text="timeLeft"></span>
                </div>

                <form method="POST" action="{{ route('verify.code') }}">
                    @csrf
                    <div>
                        <div class="flex items-center gap-2 mt-4">
                            <x-input-label for="name" :value="__('Verification code')" />
                        </div>
                        <div class="flex justify-between gap-3 mt-3">
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
                            <x-primary-button class="w-full justify-center text-sm mt-4">
                                {{ __('Verify & Continue') }}
                            </x-primary-button>

                        </div>
                    </div>
                </form>
      
                <form method="POST" action="{{ route('verification.send') }}" x-data="{ countdown: 20 }" x-init="setInterval(() => { if(countdown > 0) countdown-- }, 1000)">
                    @csrf
                    <p class="form-para color-support fw-medium small mt-4 mb-0">
                        Didn't get the code?
                    </p>
                    <button
                            type="submit"
                            :disabled="countdown > 0"
                            class="underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 mt-2 focus:ring-indigo-500"
                            :class="countdown > 0 ? 'text-gray-400 cursor-not-allowed' : 'text-blue-600 hover:text-gray-900'"
                        >
                            <span x-show="countdown === 0">Resend one-time passcode (OTP)</span>
                            <span x-show="countdown > 0">Resend available in <span x-text="countdown"></span>s</span>
                    </button>
                </form>
                              
            </div>
        </div>
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
