<div>
    <!-- It always seems impossible until it is done. - Nelson Mandela -->
    @props(['type' => 'success', 'message' => ''])

    @php
        $styles  = [
            'success' => 'bg-green-600',
            'error'   => 'bg-red-600',
            'warning' => 'bg-yellow-600',
            'info'    => 'bg-blue-600',
        ];

        $icons = [
            'success' => 'fas fa-check',
            'error' => 'fas fa-circle-info',
            'warning' => 'fas fa-exclamation-triangle',
            'info'    => 'fas fa-exclamation-circle',
        ];

        $class = $styles[$type] ?? $styles['info'];
        $icon  = $icons[$type] ?? $icons['info'];

    @endphp

    @if ($message)
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-init="setTimeout(() => show = false, 5000)" 
            x-transition 
            class="fixed top-6 left-1/2 -translate-x-1/2 z-[9999] w-full max-w-lg"
            role="alert" aria-live="assertive" aria-atomic="true"
            >
            <div class="flex items-stretch bg-white shadow-lg rounded-lg overflow-hidden">
                <!-- Left colored icon section -->
                <div class="{{ $class }} flex items-center justify-center text-white px-4 py-3 hover:bg-black transition-colors duration-300">
                    <i class="{{ $icon }} text-xl"></i>
                </div>

                <!-- Message -->
                <div class="flex-1 px-4 py-3 text-gray-800">
                    <span class="text-gray-800">{{ $message }}</span>
                </div>

                <!-- Close button -->
                <button 
                    @click="show = false" 
                    class="text-gray-500 hover:text-gray-800 px-4 focus:outline-none"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

</div>