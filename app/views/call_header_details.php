<?php
include_once("includes/header.php");
?>

<body>
    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
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
        <div class="w-full mb-1">
            <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                <div class="mb-4">
                    <h2 class="mb-4 text-xl font-semibold dark:text-white">Call ID: <?php echo htmlentities($data['call_id']) ?></h2>
                </div>
                <button id="add-call-details" class="bg-indigo-700 text-white hover:bg-indigo-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5" type="button" data-target="<?php echo htmlentities($data['call_id']); ?>">
                    Add call details
                </button>
            </div>
        </div>

        <form action="/update-call-header" method="POST">
            <div class="grid grid-cols-6 gap-6">
                <input type="hidden" name="call_id" value="<?php echo $data['call_id'] ?>" />
                <div class="col-span-6 sm:col-span-3">
                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                    <input type="datetime-local" name="date" value="<?php echo htmlentities($data['date']) ?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="it_person" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">IT Person</label>
                    <input type="text" name="it_person" value="<?php echo htmlentities($data['it_person']) ?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                    <input type="text" name="username" value="<?php echo htmlentities($data['username']) ?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject</label>
                    <input type="text" name="subject" value="<?php echo htmlentities($data['subject']) ?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                </div>
            </div>

            <div class="sm:col-span-2 mt-5">
                <label for="details" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Details</label>
                <textarea id="details" name="details" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" required><?php echo htmlentities($data['details']); ?></textarea>
            </div>

            <div class="grid grid-cols-6 gap-6 mt-5">
                <div class="sm:col-span-2">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                    <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700">
                        <option <?php if ($data['status'] == 0) {
                                    echo ('selected');
                                } ?> value="0">New</option>
                        <option <?php if ($data['status'] == 1) {
                                    echo ('selected');
                                } ?> value="1">In Progress</option>
                        <option <?php if ($data['status'] == 2) {
                                    echo ('selected');
                                } ?> value="2">Completed</option>
                    </select>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="total_hours" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Hours</label>
                    <input type="text" name="total_hours" value="<?php echo sprintf("%02d", htmlentities($data['total_hours'])) ?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" disabled>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="total_minutes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Minutes</label>
                    <input type="text" name="total_minutes" value="<?php echo sprintf("%02d", htmlentities($data['total_minutes'])) ?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" disabled>
                </div>
            </div>


            <div class="flex items-center space-x-4 mt-5">
                <button type="submit" class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Update
                </button>
            </div>
        </form>
    </div>

    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">

        <div class="w-full mb-1">
            <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                <div class="mb-4">
                    <h2 class="mb-4 text-xl font-semibold dark:text-white">Call Details</h2>
                </div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        #
                                    </th>
                                    <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Date
                                    </th>
                                    <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Details
                                    </th>
                                    <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Hours
                                    </th>
                                    <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Minutes
                                    </th>
                                    <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                <?php
                                if (isset($callDetails) && count($callDetails) > 0) {
                                    foreach ($callDetails as $index => $callDetail) {
                                ?>
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <div class="text-base font-semibold text-gray-900 dark:text-white"><?php echo ($index + 1); ?></div>
                                            </td>
                                            <td class="max-w-sm p-4 overflow-hidden text-base font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400"><?php echo htmlentities($callDetail['date']); ?></td>
                                            <td class="p-4 text-base font-medium text-gray-900 dark:text-white"><?php echo htmlentities($callDetail['details']); ?></td>
                                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo sprintf("%02d", htmlentities($callDetail['hours'])); ?></td>
                                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo sprintf("%02d", htmlentities($callDetail['minutes'])); ?></td>
                                            <td class="p-4 space-x-2 whitespace-nowrap">
                                                <button type="button" class="delete-call-detail inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800" data-target="<?php echo $callDetail['id'] ?>">
                                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="4" class="p-4 text-right">No any records found.</td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include_once("includes/footer.php");
?>