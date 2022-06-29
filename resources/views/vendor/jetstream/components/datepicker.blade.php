@props(['options' => "{enableTime: false, dateFormat: 'Y-m-d'}"])

<input x-data data-input x-ref="datepicker" x-init="flatpickr($refs.datepicker, {{ $options }} );" type="text" {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}>