<?php

namespace App\Livewire;

use Livewire\Component;

class CreateBudget extends Component
{
    //array to hold budget categories
    public $categories = [];

    //accept available departments from parent
    public $departments ;
    
    //counter for categories
    public $categoryCount = 0;

    // Initialize component state
    public function mount()
    {
        // Start with no categories
        $this->categories = [];
        $this->categoryCount = 0;

        //mount departments if not set
        if (!isset($this->departments)) {
            $this->departments = [];
        }
    }

    //add new budget category when button is clicked
    public function addCategory()
    {
        // Add new empty category to the array
        $this->categories[] = [
            'departmentId' => '',      // Department dropdown selection
            'expenseType' => '',     // Expense type text input
            'amount' => 0,           // Budget amount (numeric)
        ];

        // Increment counter for display
        $this->categoryCount++;

        /*try to dump the category when categorycount is greateer than 1
            if ($this->categoryCount > 2) {
                //dump the categories for debugging
                dump($this->categories);
            }
        */

        // Emit event to parent page to update budget summary
        // This allows real-time calculation of totals
        $this->dispatch('categoryUpdated', $this->categories);
    }

    //remove budget category at specific index when remove button is clicked
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


    //Update category values when user types 
    //this enables live updates as user fills in data
    public function updatedCategories()
    {
        // This hook runs automatically whenever $categories property changes
        // Emit event to parent for real-time summary calculation
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
                if (empty($category['departmentId'])) {
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

    // Expose categories to JS (used in fetch payload)
    public function getCategories()
    {
        return $this->categories;
    }

    //render the component view
    public function render()
    {
        return view('livewire.create-budget');
    }
}
