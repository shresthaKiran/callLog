<?php
include_once("includes/header.php");
?>

<body>
    <section class="bg-white dark:bg-gray-900 w-full">
        <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
            <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
                <div class="mb-4 col-span-full xl:mb-2">
                    <nav class="flex mb-5" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                            <li class="inline-flex items-center">
                                <a href="/" class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                                    <i class="fa-solid fa-angles-left"></i>
                                    Back
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>

                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add call details</h2>
                <form action="store-call-details" method="POST">
                    <input type="hidden" name="call_id" value="<?php echo htmlentities($callId) ?>">
                    <div class=" grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                        <div class="sm:col-span-2">
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                            <input type="datetime-local" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="details" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Details</label>
                            <textarea id="details" name="details" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="hours" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hours</label>
                            <input type="number" min="0" max="24" name="hours" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="minutes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Minutes</label>
                            <input type="number" min="0" max="60" name="minutes" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <button type="submit" class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Save
                        </button>
                    </div>
                </form>
            </div>
    </section>
</body>

<?php
include_once("includes/footer.php");
?>