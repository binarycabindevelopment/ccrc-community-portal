<a href="javascript:;" v-on:click="toggleDropdown('{{ $dropdownKey }}')" class="no-underline block py-6 sm:inline-block sm:mt-0 text-grey hover:text-blue-dark ml-8">
    {!! $slot !!} <i class="fas fa-caret-down"></i>
</a>