document.addEventListener('DOMContentLoaded', function() {
  // Khởi tạo tất cả custom dropdown
  const dropdowns = document.querySelectorAll('.custom-dropdown');
  
  dropdowns.forEach(function(dropdown) {
    const select = dropdown.querySelector('.dropdown-select');
    const menu = dropdown.querySelector('.dropdown-menu');
    const items = dropdown.querySelectorAll('.dropdown-item');
    const input = dropdown.querySelector('.dropdown-input');
    const selectedText = dropdown.querySelector('.selected-text');
    
    // Mở/đóng dropdown khi click vào select
    select.addEventListener('click', function(e) {
      e.stopPropagation();
      
      // Đóng tất cả dropdown khác
      dropdowns.forEach(function(otherDropdown) {
        if (otherDropdown !== dropdown) {
          otherDropdown.classList.remove('open');
        }
      });
      
      // Toggle dropdown hiện tại
      dropdown.classList.toggle('open');
      
    });
    
    // Xử lý chọn item
    items.forEach(function(item) {
      item.addEventListener('click', function(e) {
        e.stopPropagation();
        
        // Cập nhật giá trị đã chọn
        selectedText.textContent = item.textContent;
        input.value = item.dataset.value;
        
        // Đánh dấu item được chọn
        items.forEach(function(i) {
          i.classList.remove('selected');
        });
        item.classList.add('selected');
        
        // Đóng dropdown
        dropdown.classList.remove('open');
        
        // Gọi sự kiện change để thông báo giá trị đã thay đổi
        const event = new Event('change', { bubbles: true });
        input.dispatchEvent(event);
        
        // Cập nhật ngày sinh đầy đủ
        updateFullBirthDate();
      });
    });
    
    // Ngăn việc đóng dropdown khi click vào menu
    menu.addEventListener('click', function(e) {
      e.stopPropagation();
    });
  });
  
  // Đóng tất cả dropdown khi click ra ngoài
  document.addEventListener('click', function() {
    dropdowns.forEach(function(dropdown) {
      dropdown.classList.remove('open');
    });
  });
  
  // Cập nhật ngày sinh đầy đủ
  function updateFullBirthDate() {
    const dayInput = document.querySelector('#dayDropdown .dropdown-input');
    const monthInput = document.querySelector('#monthDropdown .dropdown-input');
    const yearInput = document.querySelector('#yearDropdown .dropdown-input');
    const fullBirthDateInput = document.getElementById('fullBirthDate');
    
    if (dayInput.value && monthInput.value && yearInput.value) {
      const day = dayInput.value.padStart(2, '0');
      const month = monthInput.value.padStart(2, '0');
      fullBirthDateInput.value = `${yearInput.value}-${month}-${day}`;
    }
  }
  
  // Gắn các sự kiện xóa trạng thái lỗi
  const birthInputs = document.querySelectorAll('.dropdown-input[required]');
  birthInputs.forEach(function(input) {
    input.addEventListener('change', function() {
      input.closest('.custom-dropdown').querySelector('.dropdown-select').classList.remove('is-invalid');
    });
  });
  
  const passwordInput = document.getElementById('password');
  if (passwordInput) {
    passwordInput.addEventListener('input', function() {
      passwordInput.classList.remove('is-invalid');
    });
  }
  
  // Export validateForm function to global scope
  window.validateForm = validateForm;
});

// Kiểm tra tuổi có đủ yêu cầu không (>=12 tuổi)
function validateAge(day, month, year, minAge = 12) {
// Tạo ngày sinh từ input
const birthDate = new Date(year, month - 1, day);

// Lấy ngày hiện tại
const currentDate = new Date();

// Tính toán tuổi
let age = currentDate.getFullYear() - birthDate.getFullYear();

// Kiểm tra nếu sinh nhật trong năm nay chưa đến
const currentMonth = currentDate.getMonth();
const birthMonth = birthDate.getMonth();

if (birthMonth > currentMonth || 
   (birthMonth === currentMonth && birthDate.getDate() > currentDate.getDate())) {
  age--;
}

// Kiểm tra tuổi có đủ điều kiện
return age >= minAge;
}

// Kiểm tra mật khẩu hợp lệ
function validatePassword(password) {
// Mật khẩu phải có ít nhất 8 ký tự, chứa chữ hoa, chữ thường và số
const hasUpperCase = /[A-Z]/.test(password);
const hasLowerCase = /[a-z]/.test(password);
const hasNumber = /[0-9]/.test(password);
const isLongEnough = password.length >= 8;

return hasUpperCase && hasLowerCase && hasNumber && isLongEnough;
}

// Hàm validation chính - gắn trực tiếp vào onSubmit của form
function validateForm() {
  // Khai báo biến isValid ngay từ đầu
  let isValid = true;

  // Kiểm tra trường họ và tên
  const fullNameInput = document.getElementById('fullName');
  if (fullNameInput && fullNameInput.value) {
    // Kiểm tra xem chuỗi sau khi xóa khoảng trắng có rỗng không
    const trimmedName = fullNameInput.value.trim();
    
    if (trimmedName.length === 0) {
      isValid = false;
      // Hiển thị thông báo lỗi
      toast({ 
        type: 'warning', 
        title: 'Cảnh báo', 
        message: 'Họ và tên không thể chỉ chứa khoảng trắng.' 
      });
      fullNameInput.classList.add('is-invalid');
    } else if (trimmedName.length < 3) {
      // Kiểm tra độ dài tối thiểu
      isValid = false;
      toast({ 
        type: 'warning', 
        title: 'Cảnh báo', 
        message: 'Họ và tên phải có ít nhất 3 ký tự.' 
      });
      fullNameInput.classList.add('is-invalid');
    } else if (fullNameInput.value.charAt(0) === ' ') {
      // Kiểm tra ký tự đầu tiên không phải space
      isValid = false;
      toast({ 
        type: 'warning', 
        title: 'Cảnh báo', 
        message: 'Họ và tên không được bắt đầu bằng khoảng trắng.' 
      });
      fullNameInput.classList.add('is-invalid');
    } else {
      fullNameInput.classList.remove('is-invalid');
    }
  }

  // Cập nhật ngày sinh đầy đủ
  updateFullBirthDate();

  // Kiểm tra các trường ngày sinh đã được chọn
  const dayInput = document.querySelector('#dayDropdown .dropdown-input');
  const monthInput = document.querySelector('#monthDropdown .dropdown-input');
  const yearInput = document.querySelector('#yearDropdown .dropdown-input');
  const passwordInput = document.getElementById('password');

  // Kiểm tra ngày sinh đã chọn đầy đủ
  if (!dayInput.value || !monthInput.value || !yearInput.value) {
    isValid = false;
    
    // Highlight dropdown chưa chọn
    if (!dayInput.value) {
      dayInput.closest('.custom-dropdown').querySelector('.dropdown-select').classList.add('is-invalid');
    }
    if (!monthInput.value) {
      monthInput.closest('.custom-dropdown').querySelector('.dropdown-select').classList.add('is-invalid');
    }
    if (!yearInput.value) {
      yearInput.closest('.custom-dropdown').querySelector('.dropdown-select').classList.add('is-invalid');
    }
  } else {
    // Kiểm tra tuổi
    const minAge = 12;
    const isAgeValid = validateAge(
      parseInt(dayInput.value), 
      parseInt(monthInput.value), 
      parseInt(yearInput.value), 
      minAge
    );
    
    if (!isAgeValid) {
      isValid = false;
      // Hiển thị thông báo lỗi
      toast({ 
        type: 'warning', 
        title: 'Cảnh báo', 
        message: `Ngày sinh phải lớn hơn ${minAge - 1} tuổi` 
      });
    }
  }

  // Kiểm tra mật khẩu
  if (passwordInput && passwordInput.value) {
    const isPasswordValid = validatePassword(passwordInput.value);
    
    if (!isPasswordValid) {
      isValid = false;
      // Hiển thị thông báo lỗi
      toast({ 
        type: 'warning', 
        title: 'Cảnh báo', 
        message: 'Mật khẩu phải có ít nhất 8 ký tự, chứa chữ hoa, chữ thường và số.' 
      });
      passwordInput.classList.add('is-invalid');
    } else {
      passwordInput.classList.remove('is-invalid');
    }
  }

  // Kiểm tra trường địa chỉ
  const addressInput = document.getElementById('address');
  if (addressInput && addressInput.value) {
    // Kiểm tra xem chuỗi sau khi xóa khoảng trắng có rỗng không
    const trimmedAddress = addressInput.value.trim();
    
    if (trimmedAddress.length === 0) {
      isValid = false;
      // Hiển thị thông báo lỗi
      toast({ 
        type: 'warning', 
        title: 'Cảnh báo', 
        message: 'Địa chỉ không thể chỉ chứa khoảng trắng.' 
      });
      addressInput.classList.add('is-invalid');
    } else if (addressInput.value.charAt(0) === ' ') {
      // Kiểm tra ký tự đầu tiên không phải space
      isValid = false;
      toast({ 
        type: 'warning', 
        title: 'Cảnh báo', 
        message: 'Địa chỉ không được bắt đầu bằng khoảng trắng.' 
      });
      addressInput.classList.add('is-invalid');
    } else {
      addressInput.classList.remove('is-invalid');
    }
  }

  // In ra debug nếu cần thiết - có thể bỏ sau khi kiểm tra xong
  console.log("Form validation result:", isValid);

  // Nếu isValid = false thì ngăn chặn submit form
  return isValid;
}
// Hàm cập nhật ngày sinh đầy đủ - đưa ra toàn cục để có thể gọi từ validateForm
function updateFullBirthDate() {
const dayInput = document.querySelector('#dayDropdown .dropdown-input');
const monthInput = document.querySelector('#monthDropdown .dropdown-input');
const yearInput = document.querySelector('#yearDropdown .dropdown-input');
const fullBirthDateInput = document.getElementById('fullBirthDate');

if (dayInput.value && monthInput.value && yearInput.value) {
  const day = dayInput.value.padStart(2, '0');
  const month = monthInput.value.padStart(2, '0');
  fullBirthDateInput.value = `${yearInput.value}-${month}-${day}`;
}
}