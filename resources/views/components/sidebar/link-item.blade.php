@props(['symbol'])
<a {{$attributes->merge(['class'=>"relative flex flex-row items-center h-11 focus:outline-none focus:border-indigo-500 hover:bg-indigo-900 text-indigo-300 hover:text-white border-l-4 border-transparent hover:border-indigo-500 pr-6 group"])}}>
  <span class="inline-flex justify-center items-center ml-4">
    <x-icon name="{{$symbol}}" class="w-5 h-5"/>
  </span>
  <span class="hidden md:block group-hover:block">
    <span class="ml-2 text-sm tracking-wide truncate">
      {{$slot}}
    </span>
  </span>

</a>
