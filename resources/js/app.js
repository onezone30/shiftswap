// import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('userForm', (config) => ({
    role:              config.role,
    positionId:        config.positionId,
    selectedBranches:  config.selectedBranches,
    allBranchIds:      config.allBranchIds,
    adminPositionId:   config.adminPositionId,
    managerPositionId: config.managerPositionId,

    setRole(newRole) {
        this.role = newRole;
        if (newRole === 'admin') {
            this.positionId = this.adminPositionId;
            this.selectedBranches = [...this.allBranchIds];
        } else if (newRole === 'manager') {
            this.positionId = this.managerPositionId;
        } else {
            this.positionId = '';
            if (this.selectedBranches.length > 1) {
                this.selectedBranches = [this.selectedBranches[0]];
            }
        }
    },

    isChecked(id) {
        return this.selectedBranches.includes(id);
    },

    toggleBranch(id) {
        if (this.role === 'admin') return;
        if (this.role === 'employee') {
            this.selectedBranches = [id];
        } else {
            const idx = this.selectedBranches.indexOf(id);
            idx > -1
                ? this.selectedBranches.splice(idx, 1)
                : this.selectedBranches.push(id);
        }
    },
}));

Alpine.start();
