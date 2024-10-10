<!-- CharacterShow.vue -->
<template>
    <div v-if="character.id == null && authRole === 'player'" class="pt-4 text-soft-white-1 flex justify-center items-center h-screen w-full">
        <div class="w-[22rem]">
            <div class="bg-soft-black-2 flex flex-col px-4 py-5 rounded-3xl">
                <h2 class='w-56 mb-4 pb-2.5 m-auto rounded-lg text-center text-xl font-bold'>Welcome !</h2>
                <p class="mb-2 text-md">DM Helper is a tool for tabletop RPG. </p>
                <p class="mb-2 text-md">As a player, you can use it to write down and update things that need to be frequently updated easier than with your character sheet.</p>
                <p class="mb-2 text-md">As a DM, it let's you manage your tables and their players. You can use it to update characters yourself or pass secret informations.</p>
                <p class="mb-2 text-md">It can't act as a replacement for your sheet (as for now), but a simple picture is enough to play at anytime.</p>
            </div>
            <div class="bg-soft-black-2 flex flex-col mt-6 px-4 pt-4 pb-5 rounded-3xl">
                <p class="mb-6">To get started, you can either create a player character or enter DM mode :</p>
                <div class="flex h-12">
                    <button class="bg-soft-white-1 mx-1 box-border w-40 font-bold pb-2 px-3 border-b-4 pt-2.5 border-soft-white-2 rounded flex text-black" @click="openCharacterAdd">
                        <svg class="relative top-[3px] right-1" width="21px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#000000" fill-rule="evenodd" d="M9 17a1 1 0 102 0v-6h6a1 1 0 100-2h-6V3a1 1 0 10-2 0v6H3a1 1 0 000 2h6v6z"/>
                        </svg>
                        Add Character
                    </button>
                    <label class="flex w-40 mx-1 items-center cursor-pointer bg-soft-black-3 rounded py-2 px-4 border-b-4 border-soft-black-2/75">
                        <input type="checkbox" v-model="isDmRoleLocal" class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-400 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-800"></div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">DM Mode</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div v-else class="bg-soft-black-1 text-soft-white-1 w-full xl:w-3/5">
        <div v-if="character.id != null && actualTab !== 'chars' && (actualTab !== 'tables' || authRole === 'player')" class="h-22 fixed w-full py-4 z-20 bg-soft-black-1/80 backdrop-blur-lg xl:w-3/5 shadow-black/15 shadow-md">
            <h1 class="block max-w-[60%] sm:max-w-[55%] md:max-w-[45%] lg:max-w-[35%] m-auto text-center text-2xl font-bold pb-1 mt-1.5 border-b-2 border-soft-white-1/25 whitespace-nowrap">{{ character.name }}</h1>
        </div>
        <div v-if="( character.id == null && authRole !== 'player' ) || actualTab === 'chars' || ( actualTab === 'tables' && authRole !== 'player' )" class="h-22 fixed w-full py-4 z-20 bg-soft-black-1/80 backdrop-blur-lg xl:w-3/5 shadow-black/15 shadow-md">
            <h1 class="block max-w-[60%] sm:max-w-[55%] md:max-w-[45%] m-auto text-center text-2xl font-bold pb-1 mt-1.5 border-b-2 border-soft-white-1/25 whitespace-nowrap">{{ upUserName }}</h1>
            </div>
            <div class="h-16 w-full bg-soft-black-1"></div>
        <span v-if="character.id == null && authRole !== 'player' && (actualTab === 'charinfos' || actualTab === 'items')" class="p-5 my-2 bg-soft-black-2 text-center text-xl block w-screen fixed top-[36vh] font-albert">{{ upUserName }} has no character yet !</span>
        <div v-if="character.id == null && authRole !== 'player' && (actualTab === 'charinfos' || actualTab === 'items')" class="w-full fixed top-[50vh]">
            <button class="bg-soft-white-1 w-40 mx-auto font-bold pb-2 px-4 border-b-4 pt-2.5 border-soft-white-2 rounded flex text-black" @click="openCharacterAdd">
                <svg class="relative top-[3px] right-1" width="21px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#000000" fill-rule="evenodd" d="M9 17a1 1 0 102 0v-6h6a1 1 0 100-2h-6V3a1 1 0 10-2 0v6H3a1 1 0 000 2h6v6z"/>
                </svg>
                Add Character
            </button>
        </div>
        <item-list v-if="actualTab === 'items' && character.id != null" :auth-role="authRole" :items="character.items" :char_id="character.id"></item-list>
        <spell-list v-if="actualTab === 'items' && character.id != null" :auth-role="authRole" :spells="character.spells" :char_id="character.id"></spell-list>
        <buff-list v-if="actualTab === 'charinfos' && character.id != null" :auth-role="authRole" :buffs="character.buffs" :char_id="character.id"></buff-list>
        <char-info-list v-if="actualTab === 'charinfos' && character.id != null" :auth-role="authRole" :char_infos="character.char_infos" :char_id="character.id"></char-info-list>
        <char-note-list v-if="actualTab === 'charinfos' && character.id != null" :char_notes="character.char_notes" :char_id="character.id"></char-note-list>
        <table-list v-if="actualTab === 'tables' && (authRole !== 'player' || character.id != null)" :auth-role="authRole" :auth-id="authId" :tables="character.tables" :char_id="character.id"></table-list>
        <character-list v-if="actualTab === 'chars' && authRole !== 'player'" :auth-role="authRole" :auth-id="authId"></character-list>
        <div class="h-32"></div>
    </div>
    <div v-if="character.id != null || authRole !== 'player'" class="fixed bottom-0 w-full h-24 text-soft-white-1 shadow-black shadow-md xl:hidden">
        <div class="bg-soft-black-3/75 w-[96%] sm:w-[70%] md:w-[60%] lg:w-[50%] xl:w-[35%] 2xl:w-[30%] rounded-3xl h-20 [backdrop-filter:blur(10px)] mx-auto">
            <div :class="{'justify-center': authRole === 'dm'}" class="fixed bottom-4 z-10 w-80 flex left-1/2 transform -translate-x-1/2">
                <button type="button" @click="toggleUserBrMenu" class="border-b-4 border-gray-600 text-white w-12 h-12 bg-gray-500 font-medium rounded-3xl text-sm py-1 text-center items-center me-2 inline-flex xl:hidden">
                    <svg width="37px" height="23px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-auto">
                        <g clip-path="url(#clip0_429_11066)">
                            <path d="M3 6.00092H21M3 12.0009H21M3 18.0009H21" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_429_11066">
                                <rect width="24" height="24" fill="white" transform="translate(0 0.000915527)"/>
                            </clipPath>
                        </defs>				
                    </svg>
                    <span class="sr-only">Toggle side menu</span>
                </button>
                <div v-if="authRole !== 'player'" class="h-8 border border-white/10 mt-2 mr-2.5 ml-1 rounded-3xl block xl:hidden"></div>
                <button type="button" v-if="authRole !== 'player'" @click="goToChars" :class="['w-12 h-12 font-medium rounded-3xl text-sm py-1 text-center inline-flex items-center me-2', actualTab === 'chars' ? ' bg-gray-600' : 'border-gray-600 bg-gray-500 border-b-4']">
                    <svg width="37px" height="27px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-auto">
                        <path id="Vector" d="M17 20C17 18.3431 14.7614 17 12 17C9.23858 17 7 18.3431 7 20M21 17.0004C21 15.7702 19.7659 14.7129 18 14.25M3 17.0004C3 15.7702 4.2341 14.7129 6 14.25M18 10.2361C18.6137 9.68679 19 8.8885 19 8C19 6.34315 17.6569 5 16 5C15.2316 5 14.5308 5.28885 14 5.76389M6 10.2361C5.38625 9.68679 5 8.8885 5 8C5 6.34315 6.34315 5 8 5C8.76835 5 9.46924 5.28885 10 5.76389M12 14C10.3431 14 9 12.6569 9 11C9 9.34315 10.3431 8 12 8C13.6569 8 15 9.34315 15 11C15 12.6569 13.6569 14 12 14Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="sr-only">Go to characters</span>
                </button>
                <button type="button" @click="goToTables" :class="['w-12 h-12 font-medium rounded-3xl text-sm py-1 text-center inline-flex items-center me-2', actualTab === 'tables' ? ' bg-gray-600' : 'border-gray-600 bg-gray-500 border-b-4']">
                    <svg width="37px" height="27px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-auto">
                        <path id="Vector" d="M3 6H3.01919M3.01919 6H9M3.01919 6C3 6.31438 3 6.70191 3 7.2002V16.8002C3 17.9203 3 18.4796 3.21799 18.9074C3.40973 19.2837 3.71547 19.5905 4.0918 19.7822C4.51921 20 5.079 20 6.19694 20L9 20M3.01919 6C3.04314 5.60768 3.09697 5.3293 3.21799 5.0918C3.40973 4.71547 3.71547 4.40973 4.0918 4.21799C4.51962 4 5.08009 4 6.2002 4H17.8002C18.9203 4 19.4796 4 19.9074 4.21799C20.2837 4.40973 20.5905 4.71547 20.7822 5.0918C20.9032 5.3293 20.957 5.60768 20.9809 6M9 6H20.9809M9 6V20M20.9809 6H21M20.9809 6C21 6.31368 21 6.70021 21 7.19691L21 16.8031C21 17.921 21 18.48 20.7822 18.9074C20.5905 19.2837 20.2837 19.5905 19.9074 19.7822C19.48 20 18.921 20 17.8031 20H9" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="sr-only">Go to tables</span>
                </button>
                <div v-if="authRole !== 'player'" class="h-8 border border-white/10 mt-2 mr-2.5 ml-1 rounded-3xl block"></div>
                <button type="button" @click="goToItems" :class="['w-12 h-12 font-medium rounded-3xl text-sm py-1 text-center inline-flex items-center me-2', actualTab === 'items' ? ' bg-gray-600' : 'border-gray-600 bg-gray-500 border-b-4']">
                    <svg fill="#ffffff" height="37px" width="23px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 192.667 192.667" xml:space="preserve" class="mx-auto">
                        <g>
                            <path d="M166.75,41.757V6.5c0-3.59-2.91-6.5-6.5-6.5h-22.333c-3.59,0-6.5,2.91-6.5,6.5v11.86c-2.741-0.45-5.551-0.694-8.417-0.694 H69.667c-2.866,0-5.676,0.244-8.417,0.694V6.5c0-3.59-2.91-6.5-6.5-6.5H32.417c-3.59,0-6.5,2.91-6.5,6.5v34.542 c0,0.224,0.011,0.445,0.034,0.663c-5.13,8.039-8.117,17.572-8.117,27.796v93.167c0,16.542,13.458,30,30,30h97 c16.542,0,30-13.458,30-30V69.5C174.833,59.299,171.859,49.785,166.75,41.757z M144.417,13h9.333v14.804 c-2.895-2.141-6.023-3.979-9.333-5.487V13z M123,30.667c13.177,0,24.834,6.602,31.858,16.667H37.809 c7.024-10.064,18.681-16.667,31.858-16.667H123z M48.25,13v9.317c-3.31,1.508-6.438,3.347-9.333,5.487V13H48.25z M161.833,162.667 c0,9.374-7.626,17-17,17h-97c-9.374,0-17-7.626-17-17V69.5c0-3.158,0.388-6.226,1.103-9.167H160.73 c0.715,2.941,1.103,6.009,1.103,9.167V162.667z" stroke-width="2"/>
                            <path d="M143,98.5H51.667c-3.59,0-6.5,2.91-6.5,6.5v57c0,3.59,2.91,6.5,6.5,6.5H143c3.59,0,6.5-2.91,6.5-6.5v-57 C149.5,101.41,146.59,98.5,143,98.5z M136.5,111.5v8.667H58.167V111.5H136.5z M58.167,155.5v-27.333H136.5V155.5H58.167z" stroke-width="2"/>
                        </g>
                    </svg>
                    <span class="sr-only">Go to items and spells</span>
                </button>
                <button type="button" @click="goToCharInfos" :class="['w-12 h-12 font-medium rounded-3xl text-sm py-1 text-center inline-flex items-center me-2', actualTab === 'charinfos' ? ' bg-gray-600' : 'border-gray-600 bg-gray-500 border-b-4']">
                    <svg width="37px" height="26px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-auto">
                        <path d="M11 3H17C18.1046 3 19 3.89543 19 5V7V17V19C19 20.1046 18.1046 21 17 21H11H5C3.89543 21 3 20.1046 3 19V17V7V5C3 3.89543 3.89543 3 5 3H11Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11 3H17H20C21.1046 3 22 3.89543 22 5V19C22 20.1046 21.1046 21 20 21H17H11" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14 12C14 13.6569 12.6569 15 11 15C9.34315 15 8 13.6569 8 12C8 10.3431 9.34315 9 11 9C12.6569 9 14 10.3431 14 12Z" stroke="#ffffff" stroke-width="2"/>
                        <path d="M7 21C7.42546 18.6928 8.51999 18 11 18C13.48 18 14.5745 18.6425 15 20.9497" stroke="#ffffff" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <span class="sr-only">Go to character infos</span>
                </button>
                <div v-if="authRole === 'player'" class="hidden sm:block h-8 border border-white/10 mt-2 mr-2.5 ml-1 rounded-3xl xl:hidden"></div>
                <div v-if="authRole !== 'dm'" class="">
                    <svg class="absolute -bottom-2 right-0 sm:-right-4 -z-10" width="64px" height="64px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.24264 8.24264L8 15L14.7574 8.24264C15.553 7.44699 16 6.36786 16 5.24264V5.05234C16 2.8143 14.1857 1 11.9477 1C10.7166 1 9.55233 1.55959 8.78331 2.52086L8 3.5L7.21669 2.52086C6.44767 1.55959 5.28338 1 4.05234 1C1.8143 1 0 2.8143 0 5.05234V5.24264C0 6.36786 0.44699 7.44699 1.24264 8.24264Z" fill="#dc2626"/>
                    </svg>
                    <button @click="minusHp" class="absolute top-7 border-b-4 border-gray-600 bg-gray-500 rounded-lg w-6 h-6 text-center">-</button>
                    <button @click="plusHp" class="absolute -top-1 border-b-4 border-gray-600 bg-gray-500 rounded-lg w-6 h-6 text-center">+</button>
                    <span class="relative -bottom-2 left-10 block w-12 text-center font-albert">{{ character.act_health }}/{{ character.max_health }}</span>
                </div>
            </div>
        </div>
    </div>
    <div v-if="character.id != null || authRole !== 'player'" class="fixed bottom-0 w-full h-24 text-soft-white-1 xl:right-0 xl:w-1/5 xl:h-screen shadow-black shadow-md xl:z-30 hidden xl:flex items-center">
        <div class=" py-6 bg-soft-black-3/25 rounded-3xl [backdrop-filter:blur(10px)] mx-auto 2xl:mx-12 w-3/4 flex justify-center items-center">
            <div :class="{'justify-center': authRole === 'dm'}" class="bottom-4 z-10 flex flex-col items-center">
                <span class="bg-soft-black-3 w-40 block p-2 px-4 text-center mt-1 mb-4 rounded-t-2xl rounded-b border-b-4 border-soft-black-2 text-soft-white-1 font-albert font-bold">Tabs</span>
                <div v-if="authRole !== 'player'" class="h-8 border border-white/10 mt-2 mr-2.5 ml-1 rounded block xl:hidden"></div>
                <button type="button" v-if="authRole !== 'player'" @click="goToChars" :class="['w-12 xl:w-40 h-12 font-medium rounded text-md my-1.5 py-1 pl-2 pr-3 text-center inline-flex items-center justify-between', actualTab === 'chars' ? ' bg-gray-600' : 'border-gray-600 bg-gray-500 border-b-4']">
                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="">
                        <path id="Vector" d="M17 20C17 18.3431 14.7614 17 12 17C9.23858 17 7 18.3431 7 20M21 17.0004C21 15.7702 19.7659 14.7129 18 14.25M3 17.0004C3 15.7702 4.2341 14.7129 6 14.25M18 10.2361C18.6137 9.68679 19 8.8885 19 8C19 6.34315 17.6569 5 16 5C15.2316 5 14.5308 5.28885 14 5.76389M6 10.2361C5.38625 9.68679 5 8.8885 5 8C5 6.34315 6.34315 5 8 5C8.76835 5 9.46924 5.28885 10 5.76389M12 14C10.3431 14 9 12.6569 9 11C9 9.34315 10.3431 8 12 8C13.6569 8 15 9.34315 15 11C15 12.6569 13.6569 14 12 14Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="xl:block flex-grow text-center font-bold">Characters</span>
                </button>
                <button type="button" @click="goToTables" :class="['w-12 xl:w-40 h-12 font-medium rounded text-md my-1.5 py-1 pl-2 pr-4 text-center inline-flex items-center justify-between', actualTab === 'tables' ? ' bg-gray-600' : 'border-gray-600 bg-gray-500 border-b-4']">
                    <svg width="25px" height="37px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="">
                        <path id="Vector" d="M3 6H3.01919M3.01919 6H9M3.01919 6C3 6.31438 3 6.70191 3 7.2002V16.8002C3 17.9203 3 18.4796 3.21799 18.9074C3.40973 19.2837 3.71547 19.5905 4.0918 19.7822C4.51921 20 5.079 20 6.19694 20L9 20M3.01919 6C3.04314 5.60768 3.09697 5.3293 3.21799 5.0918C3.40973 4.71547 3.71547 4.40973 4.0918 4.21799C4.51962 4 5.08009 4 6.2002 4H17.8002C18.9203 4 19.4796 4 19.9074 4.21799C20.2837 4.40973 20.5905 4.71547 20.7822 5.0918C20.9032 5.3293 20.957 5.60768 20.9809 6M9 6H20.9809M9 6V20M20.9809 6H21M20.9809 6C21 6.31368 21 6.70021 21 7.19691L21 16.8031C21 17.921 21 18.48 20.7822 18.9074C20.5905 19.2837 20.2837 19.5905 19.9074 19.7822C19.48 20 18.921 20 17.8031 20H9" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="xl:block flex-grow text-center font-bold">Tables</span>
                </button>
                <div v-if="authRole !== 'player'" class=" border border-white/10 my-2 mr-2.5 ml-1 w-1/2 rounded block"></div>
                <button type="button" @click="goToItems" :class="['w-12 xl:w-40 h-12 font-medium rounded text-md my-1.5 py-1 pl-2 pr-3 text-center inline-flex items-center justify-between', actualTab === 'items' ? ' bg-gray-600' : 'border-gray-600 bg-gray-500 border-b-4']">
                    <svg fill="#ffffff" height="37px" width="23px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 192.667 192.667" xml:space="preserve" class="">
                        <g>
                            <path d="M166.75,41.757V6.5c0-3.59-2.91-6.5-6.5-6.5h-22.333c-3.59,0-6.5,2.91-6.5,6.5v11.86c-2.741-0.45-5.551-0.694-8.417-0.694 H69.667c-2.866,0-5.676,0.244-8.417,0.694V6.5c0-3.59-2.91-6.5-6.5-6.5H32.417c-3.59,0-6.5,2.91-6.5,6.5v34.542 c0,0.224,0.011,0.445,0.034,0.663c-5.13,8.039-8.117,17.572-8.117,27.796v93.167c0,16.542,13.458,30,30,30h97 c16.542,0,30-13.458,30-30V69.5C174.833,59.299,171.859,49.785,166.75,41.757z M144.417,13h9.333v14.804 c-2.895-2.141-6.023-3.979-9.333-5.487V13z M123,30.667c13.177,0,24.834,6.602,31.858,16.667H37.809 c7.024-10.064,18.681-16.667,31.858-16.667H123z M48.25,13v9.317c-3.31,1.508-6.438,3.347-9.333,5.487V13H48.25z M161.833,162.667 c0,9.374-7.626,17-17,17h-97c-9.374,0-17-7.626-17-17V69.5c0-3.158,0.388-6.226,1.103-9.167H160.73 c0.715,2.941,1.103,6.009,1.103,9.167V162.667z" stroke-width="2"/>
                            <path d="M143,98.5H51.667c-3.59,0-6.5,2.91-6.5,6.5v57c0,3.59,2.91,6.5,6.5,6.5H143c3.59,0,6.5-2.91,6.5-6.5v-57 C149.5,101.41,146.59,98.5,143,98.5z M136.5,111.5v8.667H58.167V111.5H136.5z M58.167,155.5v-27.333H136.5V155.5H58.167z" stroke-width="2"/>
                        </g>
                    </svg>
                    <span class="xl:block flex-grow text-center font-bold">Inventory</span>
                </button>
                <button type="button" @click="goToCharInfos" :class="['w-12 xl:w-40 h-12 font-medium rounded text-md my-1.5 py-1 px-1.5 text-center inline-flex items-center justify-between', actualTab === 'charinfos' ? ' bg-gray-600' : 'border-gray-600 bg-gray-500 border-b-4']">
                    <svg width="27px" height="28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-auto">
                        <path d="M11 3H17C18.1046 3 19 3.89543 19 5V7V17V19C19 20.1046 18.1046 21 17 21H11H5C3.89543 21 3 20.1046 3 19V17V7V5C3 3.89543 3.89543 3 5 3H11Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11 3H17H20C21.1046 3 22 3.89543 22 5V19C22 20.1046 21.1046 21 20 21H17H11" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14 12C14 13.6569 12.6569 15 11 15C9.34315 15 8 13.6569 8 12C8 10.3431 9.34315 9 11 9C12.6569 9 14 10.3431 14 12Z" stroke="#ffffff" stroke-width="2"/>
                        <path d="M7 21C7.42546 18.6928 8.51999 18 11 18C13.48 18 14.5745 18.6425 15 20.9497" stroke="#ffffff" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <span class="xl:block flex-grow text-center font-bold">Character infos</span>
                </button>
                <span v-if="authRole !== 'dm'" class="mt-16 bg-soft-black-3 w-40 block p-2 px-4 text-center mb-4 rounded rounded-b border-b-4 border-soft-black-2 text-soft-white-1 font-albert font-bold">Life Points</span>
                <div v-if="authRole !== 'dm'" class="flex justify-center bg-soft-black-3 w-40 p-2 px-4 text-center my-1 rounded rounded-b-2xl border-b-4 border-soft-black-2">
                    <div class="flex flex-col justify-around mr-2">
                        <button @click="plusHp" class="-top-1 border-b-4 border-gray-600 bg-gray-500 rounded-lg w-6 h-6 text-center">+</button>
                        <button @click="minusHp" class="bottom-8 left-4 border-b-4 border-gray-600 bg-gray-500 rounded-lg w-6 h-6 text-center">-</button>
                    </div>
                    <div>    
                        <svg class=" -bottom-2 right-0 -z-10" width="64px" height="64px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.24264 8.24264L8 15L14.7574 8.24264C15.553 7.44699 16 6.36786 16 5.24264V5.05234C16 2.8143 14.1857 1 11.9477 1C10.7166 1 9.55233 1.55959 8.78331 2.52086L8 3.5L7.21669 2.52086C6.44767 1.55959 5.28338 1 4.05234 1C1.8143 1 0 2.8143 0 5.05234V5.24264C0 6.36786 0.44699 7.44699 1.24264 8.24264Z" fill="#dc2626"/>
                        </svg>
                        <span class="relative bottom-12 block text-center font-albert w-full h-0">{{ character.act_health }}/{{ character.max_health }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
  
<script>
import { watch, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import ItemList from './ItemList.vue';
import SpellList from './SpellList.vue';
import BuffList from './BuffList.vue';
import CharInfoList from './CharInfoList.vue';
import CharNoteList from './CharNoteList.vue';
import TableList from './TableList.vue';
import CharacterList from './CharacterList.vue';

export default {
    setup(props) {
        const actualTab = ref(['charinfos', 'tables', 'chars'].includes(props.initialTab) ? props.initialTab : 'items');
    
        const goToItems = () => {
            actualTab.value = 'items';
        };
        const goToCharInfos = () => {
            actualTab.value = 'charinfos';
        };
        const goToTables = () => {
            actualTab.value = 'tables';
        };
        const goToChars = () => {
            actualTab.value = 'chars';
        };

        let isDmRoleLocal = ref(false);

        watch(isDmRoleLocal, (newValue) => {

            axios.patch(`/users/${props.authId}/role`, { role: 'dm' })
                .then(response => {
                    // Update the authUser role after successful change
                    isDmRoleLocal = 'dm';
                    Inertia.get(route('user.show', { id: props.authId }), {}, {
            replace: true,  // Replace the current URL
            preserveState: false  // Do not preserve the current state
        });                })
                .catch(error => {
                    console.error('Error updating role:', error);
                });
        });

        return {
            actualTab,
            goToItems,
            goToCharInfos,
            goToTables,
            goToChars,
            isDmRoleLocal
        };
    },
    components: {
        ItemList,
        SpellList,
        BuffList,
        CharInfoList,
        CharNoteList,
        TableList,
        CharacterList
    },
    props: {
        character: {
            default: () => []
        },
        authRole:{
             default: () => []
        },
        authId:{
             default: () => []
        },
        toggleBrMenu: Function,
        openCharacterAdd: Function,
        initialTab: String,
        upUserName: String,
        isDmRole: Boolean,
    },
    methods: {
        toggleUserBrMenu() {
            this.toggleBrMenu();
        },
        minusHp() {
            if (this.character.act_health > 0) {
                this.character.act_health--;
                this.updateHealth();
            }
        },
        plusHp() {
            if (this.character.act_health < this.character.max_health) {
                this.character.act_health++;
                this.updateHealth();
            }
        },
        updateHealth() {
        const character = this.character;
        axios.patch(`/characters/${character.id}/update-health`, {
            act_health: character.act_health,
            max_health: character.max_health
        })
        .then(response => {
            console.log(response.data.message);
        })
        .catch(error => {
            console.error('Error updating health:', error);
        });
        },
    },
}
</script>