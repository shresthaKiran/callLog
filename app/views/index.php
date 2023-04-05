<?php
include_once("includes/header.php");
?>


<body class="bg-gray-50 dark:bg-gray-800">
  <div class="flex overflow-hidden bg-gray-50 dark:bg-gray-900">
    <main class="w-full">
      <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
        <div class="w-full mb-1">
          <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">All Call Logs</h1>
          </div>
          <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
            <form class="sm:pr-3" action="/search-call-header" method="POST">
              <div class="flex items-center mb-4 sm:mb-0">
                <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                  <input type="text" name="query" id="call-log-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="Search for call logs">
                </div>

                <div>
                  <div class="flex pl-2 space-x-1">
                    <button>
                      <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                  </div>
                </div>
            </form>
          </div>
          <button class="bg-indigo-700 text-white hover:bg-indigo-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5" type="button" id="add-call-header">
            Add a new call header
          </button>
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
                  Call Id
                </th>
                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                  Date
                </th>
                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                  IT Person
                </th>
                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                  Username
                </th>
                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                  Subject
                </th>
                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                  Total Hours
                </th>
                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                  Total Minutes
                </th>
                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                  Status
                </th>
                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                  Action
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
              <?php
              if (isset($callHeaders) && count($callHeaders) > 0) {
                foreach ($callHeaders as $callHeader) {
              ?>
                  <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                      <div class="text-base font-semibold text-gray-900 dark:text-white"><?php echo htmlentities($callHeader['call_id']); ?></div>
                    </td>
                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo htmlentities($callHeader['date']); ?></td>
                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo htmlentities($callHeader['it_person']); ?></td>
                    <td class="max-w-sm p-4 overflow-hidden text-base font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400"><?php echo htmlentities($callHeader['username']); ?></td>
                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo htmlentities($callHeader['subject']); ?></td>
                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo sprintf("%02d", htmlentities($callHeader['total_hours'])); ?></td>
                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo sprintf("%02d", htmlentities($callHeader['total_minutes'])); ?></td>
                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo getStatusName($callHeader['status']); ?></td>
                    <td class="p-4 space-x-2 whitespace-nowrap">
                      <button type="button" class="view-call-header inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-primary-300" data-target="<?php echo $callHeader['call_id'] ?>">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                          <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                          <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                        </svg>
                        View
                      </button>
                      <button type="button" class="delete-call-header inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800" data-target="<?php echo $callHeader['call_id'] ?>">
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
  </main>
  </div>
</body>
<?php
include_once("includes/footer.php");
?>