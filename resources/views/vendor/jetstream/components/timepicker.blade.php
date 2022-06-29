@props(['options' => "{enableTime: true, noCalendar: true, dateFormat: 'H:i:S', time_24hr: true, enableSeconds: true}"])

<input x-data x-init="flatpickr($refs.input, {{ $options }} );" x-ref="input" type="text" data-input {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}>