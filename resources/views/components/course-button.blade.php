<div>
    <input type="radio" name="filter-course" id="{{ $rvalue }}" {{ $checked === $rvalue ? "checked" : "" }} value="{{ $rvalue }}" class="hidden peer">
    <label for="{{ $rvalue }}" class="text-nowrap bg-white px-14 py-2 text-base rounded-lg border-2 border-white peer-checked:border-blue-800 peer-checked:border-2 peer-checked:text-blue-900 font-bold duration-150 box-border">{{ $slot }}</label>
</div>
