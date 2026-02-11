<x-Account-sidebar>
  <x-slot name="title">Vendor Management</x-slot>

  <div class="px-4 py-6 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-6xl">
      <div class="rounded-lg border border-indigo-100 bg-indigo-50/60 px-4 py-4 sm:px-5">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
          <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Create Vendor</h1>
          <p class="mt-1 text-sm text-gray-700">Add a new vendor for procurement, billing, and records.</p>
        </div>
        <div class="flex items-center gap-2">
          <span class="inline-flex items-center rounded-md bg-indigo-100 px-2 py-1 text-xs font-semibold text-indigo-700">Accounting</span>
        </div>
        </div>
      </div>

      <div class="mt-6 rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
          <h2 class="text-base font-semibold text-gray-900">Vendor Details</h2>
          <p class="mt-1 text-sm text-gray-700">Fill in the information below to register a vendor.</p>
        </div>

        <form class="px-6 py-6" method="POST" action="#">
          <div class="grid grid-cols-1 gap-6 lg:grid-cols-[220px,1fr]">
            <aside class="rounded-lg border border-indigo-100 bg-indigo-50 p-4">
              <div class="flex flex-col items-center text-center">
                <div class="flex h-20 w-20 items-center justify-center rounded-full border-4 border-white bg-indigo-100 text-indigo-700 shadow-sm">
                  <svg class="h-10 w-10" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M12 12a4 4 0 100-8 4 4 0 000 8zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z" />
                  </svg>
                </div>
                <p class="mt-3 text-sm font-semibold text-gray-800">Vendor Profile</p>
                <p class="text-xs text-gray-600">Add key identity details first.</p>
              </div>
              <div class="mt-6 rounded-md border border-indigo-100 bg-white p-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-indigo-600">Form completeness</p>
                <div class="mt-2 h-2 w-full rounded-full bg-indigo-100">
                  <div class="h-2 w-1/2 rounded-full bg-indigo-500"></div>
                </div>
                <p class="mt-2 text-xs text-gray-700">Aim to complete the required fields before saving.</p>
              </div>
            </aside>

            <div class="space-y-6">
              <!-- Vendor type and identity -->
              <div class="grid grid-cols-1 gap-4 rounded-lg border border-gray-200 bg-white p-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                  <p class="text-sm font-medium text-gray-700">Vendor Type</p>
                  <div class="mt-2 flex flex-wrap gap-3">
                    <input
                      id="vendor_type_person"
                      name="vendor_type"
                      type="radio"
                      value="person"
                      checked
                      class="peer/person sr-only"
                    />
                    <label
                      for="vendor_type_person"
                      class="flex cursor-pointer items-center gap-2 rounded-md border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-sm transition hover:border-indigo-300 peer-checked/person:border-indigo-500 peer-checked/person:bg-indigo-50 peer-checked/person:text-indigo-700"
                    >
                      Person
                    </label>
                    <input
                      id="vendor_type_company"
                      name="vendor_type"
                      type="radio"
                      value="company"
                      class="peer/company sr-only"
                    />
                    <label
                      for="vendor_type_company"
                      class="flex cursor-pointer items-center gap-2 rounded-md border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-sm transition hover:border-indigo-300 peer-checked/company:border-indigo-500 peer-checked/company:bg-indigo-50 peer-checked/company:text-indigo-700"
                    >
                      Company
                    </label>
                  </div>
                </div>
                <div class="sm:col-span-2">
                  <label class="text-sm font-medium text-gray-700" for="vendor_name">Full Name / Company Name</label>
                  <input
                    id="vendor_name"
                    name="vendor_name"
                    type="text"
                    placeholder="e.g., Brandon Freeman"
                    class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-base text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                  />
                </div>
                <div>
                  <label class="text-sm font-medium text-gray-700" for="email">Email</label>
                  <input
                    id="email"
                    name="email"
                    type="email"
                    placeholder="vendor@example.com"
                    class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                  />
                </div>
                <div>
                  <label class="text-sm font-medium text-gray-700" for="contact_phone">Phone</label>
                  <input
                    id="contact_phone"
                    name="contact_phone"
                    type="tel"
                    placeholder="+234 800 000 0000"
                    class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                  />
                </div>
                <!-- Company only -->
                <div class="grid hidden sm:col-span-2 sm:grid-cols-2 sm:gap-4" data-vendor-type="company">
                  <div>
                    <label class="text-sm font-medium text-gray-700" for="company_registration">Company Registration No</label>
                    <input
                      id="company_registration"
                      name="company_registration"
                      type="text"
                      placeholder="e.g., RC123456"
                      class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                    />
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-700" for="company_email">Company Email</label>
                    <input
                      id="company_email"
                      name="company_email"
                      type="email"
                      placeholder="accounts@company.com"
                      class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                    />
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-700" for="company_vat">VAT ID</label>
                    <input
                      id="company_vat"
                      name="company_vat"
                      type="text"
                      placeholder="e.g., VAT-209344"
                      class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                    />
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-700" for="company_website">Company Website</label>
                    <input
                      id="company_website"
                      name="company_website"
                      type="url"
                      placeholder="e.g., https://company.com"
                      class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                    />
                  </div>
                </div>
                <!-- Person only -->
                <div class="grid hidden sm:col-span-2 sm:grid-cols-2 sm:gap-4" data-vendor-type="person">
                  <div>
                    <label class="text-sm font-medium text-gray-700" for="person_first_name">First Name</label>
                    <input
                      id="person_first_name"
                      name="person_first_name"
                      type="text"
                      placeholder="e.g., John"
                      class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                    />
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-700" for="person_last_name">Last Name</label>
                    <input
                      id="person_last_name"
                      name="person_last_name"
                      type="text"
                      placeholder="e.g., Adebayo"
                      class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                    />
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-700" for="person_title">Title</label>
                    <input
                      id="person_title"
                      name="person_title"
                      type="text"
                      placeholder="e.g., Mr, Mrs, Dr"
                      class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                    />
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-700" for="person_role">Role / Position</label>
                    <input
                      id="person_role"
                      name="person_role"
                      type="text"
                      placeholder="e.g., Sales Director"
                      class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                    />
                  </div>
                </div>
              </div>

              <!-- Address + extra details layout like the sample -->
              <div class="grid grid-cols-1 gap-6 rounded-lg border border-gray-200 bg-white p-4 lg:grid-cols-2">
                <div class="space-y-4">
                  <div class="hidden" data-vendor-type="company">
                    <label class="text-sm font-medium text-gray-700" for="company_name">Company</label>
                    <input
                      id="company_name"
                      name="company_name"
                      type="text"
                      placeholder="Company Name..."
                      class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                    />
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-700" for="address">Address</label>
                    <input
                      id="address"
                      name="address"
                      type="text"
                      placeholder="Street..."
                      class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                    />
                    <input
                      id="address_2"
                      name="address_2"
                      type="text"
                      placeholder="Street 2..."
                      class="mt-3 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                    />
                  </div>
                  <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div>
                      <label class="text-sm font-medium text-gray-700" for="city">City</label>
                      <input
                        id="city"
                        name="city"
                        type="text"
                        placeholder="City"
                        class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                      />
                    </div>
                    <div>
                      <label class="text-sm font-medium text-gray-700" for="state">State</label>
                      <input
                        id="state"
                        name="state"
                        type="text"
                        placeholder="State"
                        class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                      />
                    </div>
                    <div>
                      <label class="text-sm font-medium text-gray-700" for="zip">ZIP</label>
                      <input
                        id="zip"
                        name="zip"
                        type="text"
                        placeholder="ZIP"
                        class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                      />
                    </div>
                  </div>
                </div>
                <div class="space-y-4">
                  <div class="hidden" data-vendor-type="person">
                    <label class="text-sm font-medium text-gray-700" for="job_position">Job Position</label>
                    <input
                      id="job_position"
                      name="job_position"
                      type="text"
                      placeholder="e.g., Sales Director"
                      class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                    />
                  </div>
                  <div class="hidden" data-vendor-type="company">
                    <label class="text-sm font-medium text-gray-700" for="tax_id">TIN ID</label>
                    <input
                      id="tax_id"
                      name="tax_id"
                      type="text"
                      placeholder="Optional"
                      class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                    />
                  </div>
                  <div class="hidden" data-vendor-type="company">
                    <label class="text-sm font-medium text-gray-700" for="website">Website</label>
                    <input
                      id="website"
                      name="website"
                      type="url"
                      placeholder="e.g., https://www.vendor.com"
                      class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                    />
                  </div>
                  <div>
                    <label class="text-sm font-medium text-gray-700" for="tags">Tags</label>
                    <input
                      id="tags"
                      name="tags"
                      type="text"
                      placeholder="e.g., B2B, VIP, Consulting"
                      class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                    />
                  </div>
                </div>
              </div>

              <!-- Section tabs placeholder like sample -->
              <div class="rounded-lg border border-gray-200 bg-white">
                <div class="flex flex-wrap border-b border-gray-200 text-sm font-medium text-gray-600">
                  <button type="button" class="border-b-2 border-indigo-600 px-4 py-2 text-indigo-700" data-tab-button="contacts">Contacts</button>
                  <button type="button" class="px-4 py-2 hover:text-gray-800" data-tab-button="sales">Sales &amp; Purchase</button>
                  <button type="button" class="px-4 py-2 hover:text-gray-800" data-tab-button="accounting">Accounting</button>
                  <button type="button" class="px-4 py-2 hover:text-gray-800" data-tab-button="notes">Notes</button>
                </div>
                <div class="p-4">
                  <div class="space-y-4" data-tab-panel="contacts">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                      <div>
                        <label class="text-sm font-medium text-gray-700" for="contact_name">Contact Name</label>
                        <input
                          id="contact_name"
                          name="contact_name"
                          type="text"
                          placeholder="e.g., Anita Cole"
                          class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                        />
                      </div>
                      <div>
                        <label class="text-sm font-medium text-gray-700" for="contact_role">Contact Role</label>
                        <input
                          id="contact_role"
                          name="contact_role"
                          type="text"
                          placeholder="e.g., Procurement Lead"
                          class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                        />
                      </div>
                      <div>
                        <label class="text-sm font-medium text-gray-700" for="contact_email">Contact Email</label>
                        <input
                          id="contact_email"
                          name="contact_email"
                          type="email"
                          placeholder="contact@vendor.com"
                          class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                        />
                      </div>
                      <div>
                        <label class="text-sm font-medium text-gray-700" for="contact_phone_alt">Contact Phone</label>
                        <input
                          id="contact_phone_alt"
                          name="contact_phone_alt"
                          type="tel"
                          placeholder="+234 800 111 0000"
                          class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                        />
                      </div>
                    </div>
                    <button
                      type="button"
                      class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-indigo-700 shadow-sm transition hover:bg-gray-50"
                    >
                      Add Contact
                    </button>
                  </div>

                  <div class="hidden space-y-4" data-tab-panel="sales">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                      <div>
                        <label class="text-sm font-medium text-gray-700" for="sales_terms">Sales Terms</label>
                        <input
                          id="sales_terms"
                          name="sales_terms"
                          type="text"
                          placeholder="e.g., Net 30"
                          class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                        />
                      </div>
                      <div>
                        <label class="text-sm font-medium text-gray-700" for="preferred_currency">Preferred Currency</label>
                        <input
                          id="preferred_currency"
                          name="preferred_currency"
                          type="text"
                          placeholder="e.g., NGN"
                          class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="hidden space-y-4" data-tab-panel="accounting">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                      <div>
                        <label class="text-sm font-medium text-gray-700" for="bank_name">Bank Name</label>
                        <input
                          id="bank_name"
                          name="bank_name"
                          type="text"
                          placeholder="e.g., First City Bank"
                          class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                        />
                      </div>
                      <div>
                        <label class="text-sm font-medium text-gray-700" for="account_number">Account Number</label>
                        <input
                          id="account_number"
                          name="account_number"
                          type="text"
                          placeholder="1234567890"
                          class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                        />
                      </div>
                      
                      
                    </div>
                  </div>

                  <div class="hidden space-y-4" data-tab-panel="notes">
                    <div>
                      <label class="text-sm font-medium text-gray-700" for="notes">Notes</label>
                      <textarea
                        id="notes"
                        name="notes"
                        rows="4"
                        placeholder="Add any notes about this vendor..."
                        class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"
                      ></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <button
              type="button"
              class="inline-flex items-center justify-center rounded-md border border-red-200 bg-red-50 px-4 py-2 text-sm font-medium text-red-700 shadow-sm transition hover:bg-red-100"
            >
              <svg class="mr-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
              Cancel
            </button>
            <button
              type="submit"
              class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-200"
            >
              <svg class="mr-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-2.414-2.414A2 2 0 0013.586 3H4zm0 2h8v3a1 1 0 001 1h3v7H4V5zm2 7a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1z" />
              </svg>
              Save Vendor
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const radios = document.querySelectorAll('input[name="vendor_type"]');
      const sections = document.querySelectorAll('[data-vendor-type]');
      const tabButtons = document.querySelectorAll('[data-tab-button]');
      const tabPanels = document.querySelectorAll('[data-tab-panel]');

      const updateVendorType = () => {
        const selected = document.querySelector('input[name="vendor_type"]:checked');
        const value = selected ? selected.value : null;

        sections.forEach((section) => {
          if (!value) {
            section.classList.add('hidden');
            return;
          }

          section.classList.toggle('hidden', section.dataset.vendorType !== value);
        });
      };

      radios.forEach((radio) => radio.addEventListener('change', updateVendorType));
      updateVendorType();

      const setActiveTab = (tab) => {
        tabButtons.forEach((button) => {
          const isActive = button.dataset.tabButton === tab;
          button.classList.toggle('border-b-2', isActive);
          button.classList.toggle('border-indigo-600', isActive);
          button.classList.toggle('text-indigo-700', isActive);
          button.classList.toggle('text-gray-600', !isActive);
        });

        tabPanels.forEach((panel) => {
          panel.classList.toggle('hidden', panel.dataset.tabPanel !== tab);
        });
      };

      tabButtons.forEach((button) => {
        button.addEventListener('click', () => setActiveTab(button.dataset.tabButton));
      });

      setActiveTab('contacts');
    });
  </script>

</x-Account-sidebar>