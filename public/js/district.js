function populateDistricts() {
    var provinceSelect = document.getElementById("address_province");
    var districtSelect = document.getElementById("address_district");
    districtSelect.innerHTML = ""; // Clear previous options

    var selectedProvince = provinceSelect.value;
    var districtOptions = [];

    if (selectedProvince === "Koshi") {
        districtOptions = ["Bhojpur", "Dhankuta", "Ilam", "Jhapa", "Khotang", "Morang", "Okhaldhunga", "Panchthar", "Sankhuwasabha", "Solukhumbu", "Sunnsari", "Taplejung", "Tehrathum", "Udayapur"];
    } else if (selectedProvince === "Madhesh") {
        districtOptions = ["Gaur", "Siraha", "Birgunj", "Jalesjwar", "Malangwa", "Janakpur", "Rajbiraj", "Lahan"];
    } else if (selectedProvince === "Bagmati") {
        districtOptions = ["Sindhuli", "Ramechhap", "Dolakha", "Bhaktapur", "Dhading", "Kathmandu", "Kavrepalanchok", "Lalitpur", "Nuwakot", "Rasuwa", "Sindhupalchok", "Chitwan", "Makwanpur"];
    } else if (selectedProvince === "Gandaki") {
        districtOptions = ["Baglung", "Besishahar", "Chapakot", "Modi", "Pokhara", "Waling"];
    } else if (selectedProvince === "Lumbini") {
        districtOptions = ["Kapilvastu", "Nawalparasi", "Rupandehi", "Arghakhanchi", "Gulmi", "Palpa", "Dang Deukhuri", "Pyuthan", "Rolpa", "Eastern Rukum", "Banke", "Bardiya"];
    } else if (selectedProvince === "Karnali") {
        districtOptions = ["Western Rukum", "Salyan", "Dolpa", "Humla", "Jumla", "Kalikot", "Mugu", "Surkhet", "Dailekh", "Jajarkot"];
    } else if (selectedProvince === "Sudurpashchim") {
        districtOptions = ["Achham", "Baitadi", "Bajhang", "Bajura", "Dadeldhura", "Darchula", "Doti", "Kailali", "Kanchanpur"];
    }

    // Populate the district select element
    districtOptions.forEach(function (district) {
        var option = document.createElement("option");
        option.text = district;
        districtSelect.add(option);
    });
}

// Call the function initially to populate the initial district options
populateDistricts();