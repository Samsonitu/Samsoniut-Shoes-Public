function validateDOB(dob, minAge = 12) {
    const birthDate = new Date(dob);
    const today = new Date();

    // Kiểm tra nếu ngày sinh lớn hơn ngày hiện tại
    if (birthDate > today) {
        toast({ type: 'warning', title: 'Cảnh báo', message: 'Ngày sinh không được lớn hơn ngày hiện tại' });
        return false;
    }

    const age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();

    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    if (age < minAge) {
        toast({ type: 'warning', title: 'Cảnh báo', message: `Ngày sinh phải lớn hơn ${minAge - 1} tuổi` });
        return false;
    }

    return true;
}

function validateFormCreate() {
    const password = document.getElementById("passwordCreate").value.trim();
    const confirmPassword = document.getElementById("confirmPasswordCreate").value.trim();
    const dob = document.getElementById("dobCreate").value;

    if (!validateDOB(dob)) {
        return false;
    }

    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
    if (!passwordPattern.test(password)) {
        toast({ type: 'warning', title: 'Cảnh báo', message: 'Mật khẩu phải có ít nhất 8 ký tự, chứa chữ hoa, chữ thường và số.' });
        return false;
    }

    if (password !== confirmPassword) {
        toast({ type: 'warning', title: 'Cảnh báo', message: 'Mật khẩu xác nhận không khớp' });
        return false;
    }

    return true;
}

function validateFormUpdate() {
    const password = document.getElementById("passwordUpdate").value.trim();
    const confirmPassword = document.getElementById("confirmPasswordUpdate").value.trim();
    const dob = document.getElementById("dobUpdate").value;

    if (!validateDOB(dob)) {
        return false;
    }

    // Kiểm tra mật khẩu nếu người dùng nhập mới
    if (password || confirmPassword) {
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
        if (!passwordPattern.test(password)) {
            toast({ type: 'warning', title: 'Cảnh báo', message: 'Mật khẩu phải có ít nhất 8 ký tự, chứa chữ hoa, chữ thường và số.' });
            return false;
        }

        if (password !== confirmPassword) {
            toast({ type: 'warning', title: 'Cảnh báo', message: 'Mật khẩu xác nhận không khớp' });
            return false;
        }
    }

    return true;
}



document.addEventListener('DOMContentLoaded', function () {
    new DataTable(
        'table', {
            language: {
                info: 'Hiển thị trang _PAGE_ / _PAGES_',
                infoEmpty: 'Không có tài khoản nào trùng khớp',
                infoFiltered: '(được lọc từ _MAX_ tài khoản)',
                lengthMenu: 'Hiển thị _MENU_ tài khoản',
                zeroRecords: 'Không tìm thấy tài khoản nào',
                search: 'Tìm kiếm:',
                searchPlaceholder: "Nhập từ khóa tài khoản..."
            },
        }
    );

    const modalUpdateAccount = new bootstrap.Modal(document.getElementById('modalUpdateAccount'));
    const modalChangeActiveAccount = new bootstrap.Modal(document.getElementById('modalChangeActiveAccount'));
    const modalAccountDetails = new bootstrap.Modal(document.getElementById('modalAccountDetails'));
    const modalRemoveAccount = new bootstrap.Modal(document.getElementById('modalRemoveAccount'));

    document.querySelectorAll(".btn-action--edit").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
            
            const accountRow = button.closest("tr"); 
            if (!accountRow) return;
    
            // Lấy dữ liệu từ dòng chứa tài khoản
            const userId = accountRow.dataset.userId;
            const fullName = accountRow.children[1].innerText.trim();
            const gender = accountRow.children[2].innerText.trim();
            const birthDate = accountRow.children[3].innerText.trim();
            const email = accountRow.children[4].innerText.trim();
            const phoneNumber = accountRow.children[5].innerText.trim();
            const role = accountRow.children[6].innerText.trim();
            const address = accountRow.dataset.address;
            
            // Map giá trị giới tính về đúng option value
            let genderValue = "unisex";
            if (gender === "Nam") genderValue = "male";
            else if (gender === "Nữ") genderValue = "female";
            
            // Định dạng ngày sinh từ "dd/mm/yyyy" về "yyyy-mm-dd" (định dạng input date)
            const birthDateParts = birthDate.split("/");
            const formattedBirthDate = `${birthDateParts[2]}-${birthDateParts[1]}-${birthDateParts[0]}`;

            // Gán dữ liệu vào modal cập nhật tài khoản
            modalUpdateAccount._element.querySelector('input[name="userIdUpdate"]').value = userId;
            modalUpdateAccount._element.querySelector('input[name="fullNameUpdate"]').value = fullName;
            modalUpdateAccount._element.querySelector('select[name="genderUpdate"]').value = genderValue;
            modalUpdateAccount._element.querySelector('input[name="dobUpdate"]').value = formattedBirthDate;
            modalUpdateAccount._element.querySelector('input[name="emailUpdate"]').value = email;
            modalUpdateAccount._element.querySelector('input[name="phoneNumberUpdate"]').value = phoneNumber;
            modalUpdateAccount._element.querySelector('select[name="roleUpdate"]').value = role === "Khách hàng" ? "customer" : "admin";
            modalUpdateAccount._element.querySelector('textarea[name="addressUpdate"]').value = address;

            // Hiển thị modal
            modalUpdateAccount.show();
        });
    });

    document.querySelectorAll(".btn-action--active").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.stopPropagation();
            
            const accountRow = button.closest("tr"); 
            if (!accountRow) return;
    
            // Lấy dữ liệu từ dòng chứa tài khoản
            const userId = accountRow.dataset.userId;
            const fullName = accountRow.children[1].innerText.trim();
            const active = button.dataset.active;
            const email = accountRow.dataset.email;

            let borderStyle = active == 1 ? 'border-secondary' : 'border-success' ;
            modalChangeActiveAccount._element.querySelector('button[name="SubmitChangeActiveAccount"]').classList.add(borderStyle);
            
            // Gán dữ liệu vào modal cập nhật tài khoản
            modalChangeActiveAccount._element.querySelector('input[name="userIdChangeActive"]').value = userId;
            modalChangeActiveAccount._element.querySelector('input[name="emailChangeActive"]').value = email;
            modalChangeActiveAccount._element.querySelector('input[name="changeActive"]').value = active;
            modalChangeActiveAccount._element.querySelector('#accountNameChangingActive').innerText = fullName;
            modalChangeActiveAccount._element.querySelector('#emailChangingActive').innerText = email;
            modalChangeActiveAccount._element.querySelector('#accountChangingActive').innerText = active == 1 ? 'khóa' : 'kích hoạt';

            // Hiển thị modal
            modalChangeActiveAccount.show();
        });
    });
    
    document.querySelectorAll(".btn-action--view").forEach(button => {
        button.addEventListener("click", function () {
            const accountRow = this.closest("tr");
    
            modalAccountDetails._element.querySelector("#detailFullName").textContent = accountRow.children[1].textContent;
            modalAccountDetails._element.querySelector("#detailGender").textContent = accountRow.children[2].textContent;
            modalAccountDetails._element.querySelector("#detailBirthDate").textContent = accountRow.children[3].textContent;
            modalAccountDetails._element.querySelector("#detailEmail").textContent = accountRow.dataset.email;
            modalAccountDetails._element.querySelector("#detailPhoneNumber").textContent = accountRow.children[5].textContent;
            modalAccountDetails._element.querySelector("#detailRole").textContent = accountRow.children[6].textContent;
            modalAccountDetails._element.querySelector("#detailCreateAt").textContent = accountRow.children[7].textContent;
            modalAccountDetails._element.querySelector("#detailAddress").textContent = accountRow.dataset.address || "Chưa cập nhật";
            modalAccountDetails._element.querySelector("#detailProvider").textContent = accountRow.dataset.provider || "Không có";
            modalAccountDetails._element.querySelector("#detailProviderId").textContent = accountRow.dataset.providerId || "Không có";
            modalAccountDetails._element.querySelector("#detailDescription").textContent = accountRow.dataset.description || "Không có mô tả";
            
            modalAccountDetails.show();
        });
    });
    
    document.querySelectorAll(".btn-action--delete").forEach(button => {
        button.addEventListener("click", function () {
            const accountRow = this.closest("tr");
    
            modalRemoveAccount._element.querySelector("#accountNameDelete").textContent = accountRow.children[1].textContent;
            modalRemoveAccount._element.querySelector("#emailRemove").innerText = accountRow.dataset.email;
            modalRemoveAccount._element.querySelector("input[name='emailRemove']").value = accountRow.dataset.email;
            modalRemoveAccount._element.querySelector("input[name='userIdRemove']").value = accountRow.dataset.userId;
            
            modalRemoveAccount.show();
        });
    });
    
});
