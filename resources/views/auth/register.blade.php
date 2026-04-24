@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-2xl border border-gray-100">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-indigo-600">Crear cuenta en Sabi</h2>
            <p class="mt-2 text-center text-sm text-gray-600">Únete al núcleo médico más avanzado</p>
        </div>
        
        <form class="mt-8 space-y-4" action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="rounded-md shadow-sm space-y-3">
                {{-- Nombre --}}
                <input name="nombre" type="text" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Nombre completo">
                
                {{-- Email --}}
                <input name="email" type="email" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Correo electrónico">
                
                {{-- Selector de País --}}
                <div class="relative">
                    <label class="text-xs text-gray-500 ml-1">Selecciona tu país</label>
                    <select id="country-select" name="country_code" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Cargando países...</option>
                    </select>
                </div>

                {{-- Teléfono con Prefijo --}}
                <div class="flex space-x-2">
                    <input id="phone-prefix" name="phone_prefix" type="text" readonly class="w-20 bg-gray-50 px-3 py-2 border border-gray-300 text-gray-500 text-sm rounded-md cursor-not-allowed" placeholder="+00">
                    <input name="telefono" type="text" required class="flex-1 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Número de teléfono">
                </div>

                {{-- Datos Extra de la API (Idioma y Zona Horaria) --}}
                <div class="grid grid-cols-2 gap-2">
                    <div class="relative">
                        <label class="text-xs text-gray-500 ml-1">Idioma(s)</label>
                        <input id="idioma" name="idioma" type="text" readonly class="bg-gray-50 w-full px-3 py-2 border border-gray-300 text-gray-500 text-xs rounded-md cursor-not-allowed" placeholder="---">
                    </div>
                    <div class="relative">
                        <label class="text-xs text-gray-500 ml-1">Zona Horaria</label>
                        <input id="zona-horaria" name="zona_horaria" type="text" readonly class="bg-gray-50 w-full px-3 py-2 border border-gray-300 text-gray-500 text-xs rounded-md cursor-not-allowed" placeholder="---">
                    </div>
                </div>

                {{-- Contraseñas --}}
                <input name="password" type="password" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Contraseña">
                
                <input name="password_confirmation" type="password" required class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Confirmar contraseña">
            </div>

            <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                Registrarse
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const countrySelect = document.getElementById('country-select');
        const prefixInput = document.getElementById('phone-prefix');
        const idiomaInput = document.getElementById('idioma');
        const zonaInput = document.getElementById('zona-horaria');

        // 1. Inicializamos Tom Select (el "caparazón" visual)
        const control = new TomSelect('#country-select', {
            valueField: 'cca2',
            labelField: 'name',
            searchField: 'name',
            placeholder: 'Selecciona tu país',
            render: {
                option: function(data, escape) {
                    return `<div class="flex items-center py-1">
                        <img class="w-6 h-4 mr-2 rounded-sm shadow-sm" src="${data.flag_url}">
                        <span class="text-sm text-gray-700">${escape(data.name)}</span>
                    </div>`;
                },
                item: function(data, escape) {
                    return `<div class="flex items-center">
                        <img class="w-5 h-3 mr-2 rounded-sm" src="${data.flag_url}">
                        <span class="text-gray-900">${escape(data.name)}</span>
                    </div>`;
                }
            },
            // 2. Aquí movemos tu lógica de "Actualizar campos automáticamente"
            onChange: function(value) {
                const data = this.options[value];
                if (data) {
                    prefixInput.value = data.prefix || '';
                    idiomaInput.value = data.idioma || '';
                    zonaInput.value = data.timezone || '';
                } else {
                    prefixInput.value = '';
                    idiomaInput.value = '';
                    zonaInput.value = '';
                }
            }
        });

        // 3. Tu Fetch actualizado para traer imágenes reales (flags)
        fetch('https://restcountries.com/v3.1/all?fields=name,flags,idd,cca2,languages,timezones')
            .then(response => response.json())
            .then(data => {
                // Ordenar alfabéticamente
                data.sort((a, b) => a.name.common.localeCompare(b.name.common));

                // Mapeamos los datos al formato que necesita Tom Select
                const countries = data.map(country => {
                    return {
                        cca2: country.cca2,
                        name: country.name.common,
                        flag_url: country.flags.svg, // Usamos el SVG oficial
                        prefix: country.idd.root + (country.idd.suffixes ? country.idd.suffixes[0] : ''),
                        idioma: country.languages ? Object.values(country.languages).join(', ') : 'N/A',
                        timezone: country.timezones ? country.timezones[0] : 'UTC'
                    };
                });

                // Cargamos las opciones al selector
                control.addOptions(countries);
            })
            .catch(error => {
                console.error('Error QA:', error);
            });
    });
</script>
@endsection