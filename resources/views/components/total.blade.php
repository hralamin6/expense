    <div class="bg-white dark:bg-darkSidebar p-4 my-4 mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 capitalize">
            <div class="flex items-center justify-between max-w-2xl p-4 mx-auto border border-green-500 cursor-pointer rounded-xl">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600 sm:h-9 sm:w-9" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>

                    <div class="flex flex-col items-center mx-5 space-y-1">
                        <h2 class="text-lg font-medium text-gray-700 sm:text-2xl dark:text-gray-200">total income</h2>
                    </div>
                </div>

                <h2 class="text-2xl font-semibold text-green-600 sm:text-3xl">{{ $income }} <span class="text-base font-medium"> bdt</span></h2>
            </div>
            <div class="flex items-center justify-between max-w-2xl p-4 mx-auto border border-red-500 cursor-pointer rounded-xl">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600 sm:h-9 sm:w-9" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>

                    <div class="flex flex-col items-center mx-5 space-y-1">
                        <h2 class="text-lg font-medium text-gray-700 sm:text-2xl dark:text-gray-200">total expense</h2>
                    </div>
                </div>

                <h2 class="text-2xl font-semibold text-red-600 sm:text-3xl">{{ $expense }} <span class="text-base font-medium">bdt</span></h2>
            </div>
            <div class="flex items-center justify-between max-w-2xl p-4 mx-auto border border-blue-500 cursor-pointer rounded-xl">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600 sm:h-9 sm:w-9" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>

                    <div class="flex flex-col items-center mx-5 space-y-1">
                        <h2 class="text-lg font-medium text-gray-700 sm:text-2xl dark:text-gray-200">total balance</h2>
                    </div>
                </div>

                <h2 class="text-2xl font-semibold text-blue-600 sm:text-3xl">{{ $balance }} <span class="text-base font-medium">bdt</span></h2>
            </div>
    </div>
