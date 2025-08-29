<div>
    <!-- It always seems impossible until it is done. - Nelson Mandela -->
    @props(['type' => 'success', 'message' => ''])

    @php
        $styles  = [
            'success' => 'bg-green-100 border-green-400 text-green-700',
            'error'   => 'bg-red-100 border-red-400 text-red-700',
            'warning' => 'bg-yellow-100 border-yellow-400 text-yellow-700',
            'info'    => 'bg-blue-100 border-blue-400 text-blue-700',
        ];
        $class = $styles[$type] ?? $styles['info'];
    @endphp

    @if ($message)
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-init="setTimeout(() => show = false, 5000)" 
            class="fixed bottom-6 left-6 z-50"
        >
            <div class="{{ $class }} px-4 py-3 rounded-lg shadow-lg border">
                <span class="font-medium">{{ $message }}</span>
                  <button 
                    x-on:click="show = false" 
                    class="text-xl font-bold leading-none focus:outline-none hover:text-black"
                >
                    &times;
                </button>
            </div>
        </div>
    @endif

</div>