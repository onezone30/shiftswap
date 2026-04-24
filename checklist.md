
1. Controllers:

1.1 Create `app/Http/Controllers/ShiftController.php` with the following methods:

- `index()` — list shifts with optional filters (branch, position, week/date range).
- `create()` — show form to create a dated `Shift`.
- `store(StoreShiftRequest $request)` — validate and create a `Shift`.
- `show(Shift $shift)` — display shift details and link to request swap.
- `edit(Shift $shift)` — show edit form.
- `update(UpdateShiftRequest $request, Shift $shift)` — validate and update.
- `destroy(Shift $shift)` — delete the shift.

1.2 Create `app/Http/Controllers/ShiftSwapController.php` with the following methods:

- `index()` — list swap requests (filtered by role: employee sees own, manager sees branch pending approvals).
- `create()` — show form to request a swap (or provide a `shift_id` param when linked from a shift).
- `store(StoreShiftSwapRequest $request)` — create a swap request (set `requested_by` = auth user).
- `show(ShiftSwap $shiftSwap)` — show request details and timeline.
- `respond(RespondShiftSwapRequest $request, ShiftSwap $shiftSwap)` — endpoint for the `requested_to` user to accept/reject; set `recipient_responded_at` and update `status` to `pending_manager` when accepted.
- `approve(ReviewShiftSwapRequest $request, ShiftSwap $shiftSwap)` — manager approves the swap, set `reviewed_by`, `reviewed_at`, update `status` to `approved`, and reassign `shift.user_id` atomically.
- `reject(ReviewShiftSwapRequest $request, ShiftSwap $shiftSwap)` — manager rejects the request and set `status` to `rejected` with `review_notes`.
- `destroy(ShiftSwap $shiftSwap)` — cancel a pending swap (by requester) or admin removal.

2. Validation & Security:

2.1 Create these Form Request classes under `app/Http/Requests/`:

- `StoreShiftRequest.php` — validate `branch_id`, `position_id`, optional `user_id`, `shift_date` (date), `start_time`, `end_time`, `status`, `notes`.
- `UpdateShiftRequest.php` — same rules as `StoreShiftRequest` with `sometimes` rules as needed.
- `StoreShiftSwapRequest.php` — validate `shift_id` exists, ensure `requested_to` is a valid user and eligible (same branch & same position), `request_message` optional.
- `RespondShiftSwapRequest.php` — validate `accepted` boolean and optional `response_message` (used by recipient).
- `ReviewShiftSwapRequest.php` — validate `approved` boolean and optional `review_notes` (used by manager approval/rejection).

2.2 Create these Policy classes under `app/Policies/`:

- `ShiftPolicy.php` — implement `viewAny`, `view`, `create`, `update`, `delete`, and an extra `manage` or `assign` method for managers (scope checks: manager can manage shifts for their branch, employees only for own shifts).
- `ShiftSwapPolicy.php` — implement `viewAny`, `view`, `create`, `respond` (recipient only), `approve` (manager only), `delete` (requester or admin).

2.3 Register policies in `app/Providers/AuthServiceProvider.php`:

```php
protected $policies = [
    \App\Models\Shift::class => \App\Policies\ShiftPolicy::class,
    \App\Models\ShiftSwap::class => \App\Policies\ShiftSwapPolicy::class,
];
```

3. Routing:

3.1 Add the following to `routes/web.php` inside the existing `Route::middleware('auth')->group(...)` block (or create one):

```php
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\ShiftSwapController;

Route::resource('shifts', ShiftController::class);
Route::resource('shift-swaps', ShiftSwapController::class)->parameters(['shift-swaps' => 'shiftSwap']);

// Custom actions for swap lifecycle
Route::post('shift-swaps/{shiftSwap}/respond', [ShiftSwapController::class, 'respond'])->name('shift-swaps.respond');
Route::post('shift-swaps/{shiftSwap}/approve', [ShiftSwapController::class, 'approve'])->name('shift-swaps.approve');
Route::post('shift-swaps/{shiftSwap}/reject', [ShiftSwapController::class, 'reject'])->name('shift-swaps.reject');
```

3.2 Ensure route-model binding parameter names match controllers (use `ShiftSwap $shiftSwap` in controller methods).

4. UI / Blade Views (create these files and include these UI elements based on model fillables):

4.1 `resources/views/shifts/index.blade.php` — list/table of shifts with:

- Filters: branch select, position select, date/week picker.
- Columns: Branch (`$shift->branch->name`), Position, Employee (`$shift->user->name`), `shift_date`, `start_time`, `end_time`, `status`, `notes` (short), Actions (View, Edit — if authorized, Delete).

4.2 `resources/views/shifts/create.blade.php` and `resources/views/shifts/edit.blade.php` — form with fields:

- `branch_id` (select), `position_id` (select), `user_id` (select, optional), `shift_date` (date input), `start_time` (time input), `end_time` (time input), `status` (select: assigned, pending_swap, swapped, unassigned, cancelled), `notes` (textarea). Include validation error display and CSRF.

4.3 `resources/views/shifts/show.blade.php` — full shift detail and a button/link to request a swap (opens `shift-swaps.create` with `shift_id` prefilled).

4.4 `resources/views/shift-swaps/index.blade.php` — list swap requests with columns:

- Shift summary (date, time, position, branch), Requester (`requested_by`), Recipient (`requested_to`), `status`, `request_message` (short), `recipient_responded_at`, `reviewed_at`, Actions (Respond if current user == `requested_to`, Approve/Reject if current user is branch manager, View details).

4.5 `resources/views/shift-swaps/create.blade.php` — form (if not created from shift `show`):

- Hidden `shift_id` or select shift, `requested_to` (select from eligible users prefiltered by branch & position), `request_message` textarea, submit.

4.6 `resources/views/shift-swaps/show.blade.php` — detailed request page showing all fields: `shift` details, `requester`, `recipient`, `status`, `request_message`, `review_notes`, timestamps; include action buttons per-role (Respond, Approve, Reject).

4.7 Partial components (optional but recommended):

- `resources/views/shifts/_form.blade.php` — shared form for create/edit (fields listed above).
- `resources/views/shift-swaps/_actions.blade.php` — per-row action buttons rendered based on policy checks.

5. Notes / skip list:

5.1 Skip generation of models and migrations — they already exist (`app/Models/Shift.php`, `app/Models/ShiftSwap.php`, migrations under `database/migrations`).

5.2 After scaffolding controllers/requests/policies/routes/views run `php artisan migrate:fresh --seed` and manually test the CRUD and swap flows.


---

**Developer tips & conventions**

- Keep models simple: `Shift` (branch_id, position_id, user_id, shift_date, start_time, end_time, status).
- Enforce business rules in Form Requests or small Action classes (e.g., `ApproveSwapAction`).
- Use policies, not controller conditionals, to centralize authorization.

---

**Acceptance for a developer demo**

- Employee: view shifts and request a swap.
- Coworker: accept/decline swap.
- Manager: approve/reject accepted swaps; approved swap reassigns the `shift.user_id`.
- Notifications: in-app + email sent on key events.

---

If you'd like I can scaffold the controllers, requests, and policies now (one-by-one). Which do you want first? `ShiftController` or `ShiftSwapController`?
