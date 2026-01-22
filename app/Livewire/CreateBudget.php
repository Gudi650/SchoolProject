<?php

namespace App\Livewire;

use Livewire\Component;

class CreateBudget extends Component
{
    /**
     * Array to store all budget categories
     * Each category contains: department, expenseType, amount
     * 
     * @var array
     */
    public $categories = [];

    /**
     * Available departments for dropdown selection
     * This prevents inconsistent typing and data fragmentation
     * 
     * @var array
     */
    public $availableDepartments = [
        'Academic',
        'Infrastructure',
        'Library',
        'Sports',
        'Transportation',
        'Administration',
    ];

    /**
     * Counter to track total categories added
     * Used for display purposes and statistics
     * 
     * @var int
     */
    public $categoryCount = 0;

    /**
     * Initialize component with empty state
     * Called when component first loads
     */
    public function mount()
    {
        // Start with no categories
        $this->categories = [];
        $this->categoryCount = 0;
    }

    /**
     * Add a new budget category row
     * Creates empty category with default values
     * User will fill in department, expense type, and amount
     * 
     * @return void
     */
    public function addCategory()
    {
        // Add new empty category to the array
        $this->categories[] = [
            'department' => '',      // Department dropdown selection
            'expenseType' => '',     // Expense type text input
            'amount' => 0,           // Budget amount (numeric)
        ];

        // Increment counter for display
        $this->categoryCount++;

        // Emit event to parent page to update budget summary
        // This allows real-time calculation of totals
        $this->dispatch('categoryUpdated', $this->categories);
    }

    /**
     * Remove a specific budget category by index
     * Updates the categories array and recalculates summary
     * 
     * @param int $index - The array index of category to remove
     * @return void
     */
    public function removeCategory($index)
    {
        // Check if index exists to prevent errors
        if (isset($this->categories[$index])) {
            // Remove category from array
            unset($this->categories[$index]);
            
            // Re-index array to maintain sequential keys
            // This prevents gaps like [0, 2, 3] becoming [0, 1, 2]
            $this->categories = array_values($this->categories);
            
            // Decrement counter
            $this->categoryCount--;
            
            // Emit event to update parent summary
            $this->dispatch('categoryUpdated', $this->categories);
        }
    }

    /**
     * Update category values when user types
     * Triggered by wire:change or wire:model.live
     * Emits event to recalculate budget summary in real-time
     * 
     * @return void
     */
    public function updatedCategories()
    {
        // This hook runs automatically whenever $categories property changes
        // Emit event to parent for real-time summary calculation
        $this->dispatch('categoryUpdated', $this->categories);
    }

    /**
     * Get all categories for form submission
     * Can be called from parent component/page
     * 
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Load categories from existing budget (for copy/edit feature)
     * 
     * @param array $existingCategories - Array of categories to load
     * @return void
     */
    public function loadCategories($existingCategories)
    {
        // Clear current categories
        $this->categories = [];
        
        // Load each category
        foreach ($existingCategories as $category) {
            $this->categories[] = [
                'department' => $category['department'] ?? '',
                'expenseType' => $category['expenseType'] ?? '',
                'amount' => $category['amount'] ?? 0,
            ];
        }
        
        // Update counter
        $this->categoryCount = count($this->categories);
        
        // Emit update event
        $this->dispatch('categoryUpdated', $this->categories);
    }

    /**
     * Validate categories before submission
     * Ensures all required fields are filled
     * 
     * @return bool
     */
    public function validateCategories()
    {
        // Check if at least one category exists
        if (empty($this->categories)) {
            // Dispatch error event to parent
            $this->dispatch('categoryError', 'Please add at least one budget category');
            return false;
        }

        // Validate each category
        foreach ($this->categories as $index => $category) {
            // Check department is selected
            if (empty($category['department'])) {
                $this->dispatch('categoryError', "Category " . ($index + 1) . ": Please select a department");
                return false;
            }

            // Check expense type is filled
            if (empty($category['expenseType'])) {
                $this->dispatch('categoryError', "Category " . ($index + 1) . ": Please enter expense type");
                return false;
            }

            // Check amount is greater than zero
            if (!isset($category['amount']) || $category['amount'] <= 0) {
                $this->dispatch('categoryError', "Category " . ($index + 1) . ": Amount must be greater than zero");
                return false;
            }
        }

        return true;
    }

    /**
     * Render the Livewire component view
     * Returns the blade template for categories section
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.create-budget');
    }
}
