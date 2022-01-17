@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'peer h-12 w-full border border-1.5 rounded-md border-gray-300 text-gray-900 placeholder-transparent focus:border-indigo-300 focus:ring focus:ring-indigo-900 focus:ring-opacity-50 focus:border-2 p-3 focus:invalid:border-pink-500 focus:invalid:ring-pink-500']) !!}>
	{{$slot}}
</select>