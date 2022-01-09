@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'peer h-12 w-full border-gray-300 border-1.5 rounded-md  placeholder-transparent focus:border-indigo-300 focus:ring focus:ring-indigo-900 focus:ring-opacity-50 rounded-md py-6 px-6 text-gray-400 text-lg font-semibold']) !!}>