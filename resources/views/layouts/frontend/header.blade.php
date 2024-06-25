
<header class="header-area style-2">
    <div class="header-logo">
        <a href="index.html"><img alt="image" class="img-fluid" src="{{ asset('uploads/system').'/'. companyInfo()->website_logo }}" width="50px"></a>
    </div>
    <div class="main-menu">
        <div class="mobile-logo-area d-lg-none d-flex justify-content-between align-items-center">
            <div class="mobile-logo-wrap">
                <a href="index.html"><img alt="image" src="{{ asset('frontend/img/logo2.svg') }}"></a>
            </div>
            <div class="menu-close-btn">
                <i class="bi bi-x"></i>
            </div>
        </div>
        <ul class="menu-list">
            <li class="menu-item-has-children active">
                <a href="#" class="drop-down">Home</a></i>
                {{-- <ul class="sub-menu">
                    <li><a href="index.html">Home 01</a></li>
                    <li class="active"><a href="javascript::">Home 02</a></li>
                    <li><a href="javascritp::">Home 03</a></li>
                    <li><a href="javascritp::">Home 04</a></li>
                    <li><a href="javascritp::">Home 05</a></li>
                    <li><a href="javascritp::">Home 06</a></li>
                </ul> --}}
            </li>
            <li>
                <a href="about.html" class="drop-down">About</a>
            </li>
            <li class="menu-item-has-children">
                <a href="package-grid.html" class="drop-down">Tours</a><i class="bi bi-plus dropdown-icon"></i>
                <ul class="sub-menu">
                    <li><a href="package-grid.html">Package Grid</a></li>
                    <li>
                        <a href="package-sidebar.html">Package Sidebar</a>
                    </li>
                    <li>
                        <a href="package-top-search.html">Package Top Search</a>
                    </li>
                    <li>
                        <a href="package-category.html">Package Category</a>
                    </li>
                    <li>
                        <a href="package-details.html">Package Details</a>
                    </li>
                </ul>
            </li>
            <li class="menu-item-has-children">
                <a href="destination1.html" class="drop-down">Destination</a><i class="bi bi-plus dropdown-icon"></i>
                <ul class="sub-menu">
                    <li><a href="destination1.html">Destination Style 01</a></li>
                    <li><a href="destination2.html">Destination Style 02</a></li>
                    <li><a href="destination3.html">Destination Style 03</a></li>
                    <li><a href="destination4.html">Destination Style 04</a></li>
                    <li><a href="destination5.html">Destination Style 05</a></li>
                    <li><a href="destination-details.html">Destination Details</a></li>
                </ul>
            </li>
            <li class="menu-item-has-children">
                <a href="#" class="drop-down">Pages</a><i class="bi bi-plus dropdown-icon"></i>
                <ul class="sub-menu">
                    <li>
                        <a href="hotel-suits.html">Hotel</a>
                        <i class="d-lg-flex d-none bi bi-chevron-right dropdown-icon"></i>
                        <i class="d-lg-none d-flex bi bi-plus dropdown-icon"></i>
                        <ul class="sub-menu">
                            <li><a href="hotel-suits.html">Hotel</a></li>
                            <li><a href="hotel-details.html">Hotel Details</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="activities.html">Activities</a>
                        <i class="d-lg-flex d-none bi bi-chevron-right dropdown-icon"></i>
                        <i class="d-lg-none d-flex bi bi-plus dropdown-icon"></i>
                        <ul class="sub-menu">
                            <li><a href="activities.html">Activities</a></li>
                            <li><a href="activities-details.html">Activities Details</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="transport.html">Transport</a>
                        <i class="d-lg-flex d-none bi bi-chevron-right dropdown-icon"></i>
                        <i class="d-lg-none d-flex bi bi-plus dropdown-icon"></i>
                        <ul class="sub-menu">
                            <li><a href="transport.html">Transport</a></li>
                            <li><a href="transport-details.html">Transport Details</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="visa.html">Visa</a>
                        <i class="d-lg-flex d-none bi bi-chevron-right dropdown-icon"></i>
                        <i class="d-lg-none d-flex bi bi-plus dropdown-icon"></i>
                        <ul class="sub-menu">
                            <li><a href="visa.html">Visa</a></li>
                            <li><a href="visa-details.html">Visa Details</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="blog-grid.html">Blog</a>
                        <i class="d-lg-flex d-none bi bi-chevron-right dropdown-icon"></i>
                        <i class="d-lg-none d-flex bi bi-plus dropdown-icon"></i>
                        <ul class="sub-menu">
                            <li><a href="blog-grid.html">Blog Grid</a></li>
                            <li><a href="blog-standard.html">Blog Standard</a></li>
                            <li><a href="blog-grid-sidebar.html">Blog Grid Sidebar</a></li>
                            <li><a href="blog-standard-sidebar.html">Blog Standard Sidebar</a></li>
                            <li><a href="blog-details.html">Blog Details</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="guide1.html">Tour Guide</a>
                        <i class="d-lg-flex d-none bi bi-chevron-right dropdown-icon"></i>
                        <i class="d-lg-none d-flex bi bi-plus dropdown-icon"></i>
                        <ul class="sub-menu">
                            <li><a href="guide1.html">Tour Guide Style 01</a></li>
                            <li><a href="guide2.html">Tour Guide Style 02</a></li>
                            <li><a href="guide3.html">Tour Guide Style 03</a></li>
                            <li><a href="guide4.html">Tour Guide Style 04</a></li>
                            <li><a href="guide5.html">Tour Guide Style 05</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="shop.html">Shop</a>
                        <i class="d-lg-flex d-none bi bi-chevron-right dropdown-icon"></i>
                        <i class="d-lg-none d-flex bi bi-plus dropdown-icon"></i>
                        <ul class="sub-menu">
                            <li><a href="shop.html">Shop</a></li>
                            <li><a href="product-details.html">Product Details</a></li>
                            <li><a href="cart.html">Cart</a></li>
                            <li><a href="checkout.html">CheckOut</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="dashboard.html">Dashboard</a>
                        <i class="d-lg-flex d-none bi bi-chevron-right dropdown-icon"></i>
                        <i class="d-lg-none d-flex bi bi-plus dropdown-icon"></i>
                        <ul class="sub-menu">
                            <li><a href="dashboard.html">Admin Dashboard</a></li>
                            <li><a href="customer-dashboard.html">Customer Dashboard</a></li>
                        </ul>
                    </li>
                    <li><a href="gallery.html">Gallery</a></li>
                    <li><a href="faq.html">Faqs</a></li>
                    <li><a href="error.html">Error</a></li>
                </ul>
            </li>
            <li>
                <a href="contact.html" class="drop-down">Contact</a>
            </li>
        </ul>
        <div class="topbar-right d-lg-none d-block">
            <button type="button" class="modal-btn header-cart-btn" data-bs-toggle="modal" data-bs-target="#user-login">
                <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M14.4311 12.759C15.417 11.4291 16 9.78265 16 8C16 3.58169 12.4182 0 8 0C3.58169 0 0 3.58169 0 8C0 12.4182 3.58169 16 8 16C10.3181 16 12.4058 15.0141 13.867 13.4387C14.0673 13.2226 14.2556 12.9957 14.4311 12.759ZM13.9875 12C14.7533 10.8559 15.1999 9.48009 15.1999 8C15.1999 4.02355 11.9764 0.799983 7.99991 0.799983C4.02355 0.799983 0.799983 4.02355 0.799983 8C0.799983 9.48017 1.24658 10.8559 2.01245 12C2.97866 10.5566 4.45301 9.48194 6.17961 9.03214C5.34594 8.45444 4.79998 7.49102 4.79998 6.39995C4.79998 4.63266 6.23271 3.19993 8 3.19993C9.76729 3.19993 11.2 4.63266 11.2 6.39995C11.2 7.49093 10.654 8.45444 9.82039 9.03206C11.5469 9.48194 13.0213 10.5565 13.9875 12ZM13.4722 12.6793C12.3495 10.8331 10.3188 9.59997 8.00008 9.59997C5.68126 9.59997 3.65049 10.8331 2.52776 12.6794C3.84829 14.2222 5.80992 15.2 8 15.2C10.1901 15.2 12.1517 14.2222 13.4722 12.6793ZM8 8.79998C9.32551 8.79998 10.4 7.72554 10.4 6.39995C10.4 5.07444 9.32559 3.99992 8 3.99992C6.6744 3.99992 5.59997 5.07452 5.59997 6.40003C5.59997 7.72554 6.67449 8.79998 8 8.79998Z"
                    >
                    </path>
                </svg>
                REGISTER/ LOGIN
            </button>
        </div>
        <div class="hotline-area d-lg-none d-flex">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28">
                    <path
                        d="M27.2653 21.5995L21.598 17.8201C20.8788 17.3443 19.9147 17.5009 19.383 18.1798L17.7322 20.3024C17.6296 20.4377 17.4816 20.5314 17.3154 20.5664C17.1492 20.6014 16.9759 20.5752 16.8275 20.4928L16.5134 20.3196C15.4725 19.7522 14.1772 19.0458 11.5675 16.4352C8.95784 13.8246 8.25001 12.5284 7.6826 11.4893L7.51042 11.1753C7.42683 11.0269 7.39968 10.8532 7.43398 10.6864C7.46827 10.5195 7.56169 10.3707 7.69704 10.2673L9.81816 8.61693C10.4968 8.08517 10.6536 7.1214 10.1784 6.40198L6.39895 0.734676C5.91192 0.00208106 4.9348 -0.21784 4.18082 0.235398L1.81096 1.65898C1.06634 2.09672 0.520053 2.80571 0.286612 3.63733C-0.56677 6.74673 0.0752209 12.1131 7.98033 20.0191C14.2687 26.307 18.9501 27.9979 22.1677 27.9979C22.9083 28.0011 23.6459 27.9048 24.3608 27.7115C25.1925 27.4783 25.9016 26.932 26.3391 26.1871L27.7641 23.8187C28.218 23.0645 27.9982 22.0868 27.2653 21.5995ZM26.9601 23.3399L25.5384 25.7098C25.2242 26.2474 24.7142 26.6427 24.1152 26.8128C21.2447 27.6009 16.2298 26.9482 8.64053 19.3589C1.0513 11.7697 0.398595 6.75515 1.18669 3.88421C1.35709 3.28446 1.75283 2.77385 2.2911 2.45921L4.66096 1.03749C4.98811 0.840645 5.41221 0.93606 5.62354 1.25397L7.67659 4.3363L9.39976 6.92078C9.60612 7.23283 9.53831 7.65108 9.24392 7.88199L7.1223 9.53232C6.47665 10.026 6.29227 10.9193 6.68979 11.6283L6.85826 11.9344C7.45459 13.0281 8.19599 14.3887 10.9027 17.095C13.6095 19.8012 14.9696 20.5427 16.0628 21.139L16.3694 21.3079C17.0783 21.7053 17.9716 21.521 18.4653 20.8753L20.1157 18.7537C20.3466 18.4595 20.7647 18.3918 21.0769 18.5979L26.7437 22.3773C27.0618 22.5885 27.1572 23.0128 26.9601 23.3399ZM15.8658 4.66809C20.2446 4.67296 23.7931 8.22149 23.798 12.6003C23.798 12.858 24.0069 13.0669 24.2646 13.0669C24.5223 13.0669 24.7312 12.858 24.7312 12.6003C24.7257 7.7063 20.7598 3.74029 15.8658 3.73494C15.6081 3.73494 15.3992 3.94381 15.3992 4.20151C15.3992 4.45922 15.6081 4.66809 15.8658 4.66809Z"
                    />
                    <path d="M15.865 7.46746C18.6983 7.4708 20.9943 9.76678 20.9976 12.6001C20.9976 12.7238 21.0468 12.8425 21.1343 12.93C21.2218 13.0175 21.3404 13.0666 21.4642 13.0666C21.5879 13.0666 21.7066 13.0175 21.7941 12.93C21.8816 12.8425 21.9308 12.7238 21.9308 12.6001C21.9269 9.2516 19.2134 6.53813 15.865 6.5343C15.6073 6.5343 15.3984 6.74318 15.3984 7.00088C15.3984 7.25859 15.6073 7.46746 15.865 7.46746Z" />
                    <path d="M15.865 10.267C17.1528 10.2686 18.1964 11.3122 18.198 12.6C18.198 12.7238 18.2472 12.8424 18.3347 12.9299C18.4222 13.0174 18.5409 13.0666 18.6646 13.0666C18.7883 13.0666 18.907 13.0174 18.9945 12.9299C19.082 12.8424 19.1312 12.7238 19.1312 12.6C19.1291 10.797 17.668 9.33589 15.865 9.33386C15.6073 9.33386 15.3984 9.54274 15.3984 9.80044C15.3984 10.0581 15.6073 10.267 15.865 10.267Z" />
                </svg>
            </div>
            <div class="content">
                <span>To More Inquiry</span>
                <h6><a href="tel:+990737621432">+990-737 621 432</a></h6>
            </div>
        </div>
    </div>
    <div class="nav-right d-flex jsutify-content-end align-items-center">
        <ul class="icon-list">
            <li class="d-lg-flex d-none">
                <a href="#" data-bs-toggle="modal" data-bs-target="#user-login">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                        <path d="M26 13.5C26 20.4036 20.4035 26 13.5 26C6.59632 26 1 20.4036 1 13.5C1 6.59632 6.59632 1 13.5 1C20.4035 1 26 6.59632 26 13.5Z" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M18.5001 11.8333C18.5001 14.5947 16.2616 16.8333 13.5001 16.8333C10.7384 16.8333 8.5 14.5947 8.5 11.8333C8.5 9.07189 10.7384 6.8333 13.5001 6.8333C16.2616 6.8333 18.5001 9.07189 18.5001 11.8333Z" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.04297 23.5324C6.44287 19.7667 9.62917 16.8333 13.5008 16.8333C17.3725 16.8333 20.5588 19.7669 20.9585 23.5325" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </li>
            <li class="right-sidebar-button">
                <svg class="sidebar-toggle-button" width="25" height="25" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.29608 0.0658336C0.609639 0.31147 0.139209 0.899069 0.0432028 1.63598C-0.0144009 2.09353 -0.0144009 5.4939 0.0432028 5.95146C0.129608 6.59686 0.489632 7.11703 1.07047 7.42046L1.36329 7.57458H3.83545H6.30761L6.59563 7.42046C6.96525 7.2278 7.25807 6.93401 7.45008 6.56314L7.60369 6.27416V3.79372V1.31328L7.45008 1.02429C7.25807 0.653433 6.96525 0.359633 6.59563 0.166978L6.30761 0.0128531L3.90745 0.00322056C1.83372 -0.00641251 1.4785 0.00322056 1.29608 0.0658336ZM6.2356 0.802741C6.52842 0.956866 6.65803 1.08209 6.79244 1.34699L6.90765 1.57336V3.80817V6.03816L6.74924 6.29824C6.53322 6.66429 6.2068 6.85694 5.74117 6.90029C5.54916 6.91956 4.55549 6.92437 3.52343 6.91474L1.65131 6.90029L1.41129 6.77025C1.12807 6.62094 1.00807 6.49571 0.854455 6.20191L0.739248 5.98518V3.79372V1.60226L0.854455 1.38552C1.05607 0.995397 1.33929 0.778659 1.74731 0.706413C1.85292 0.687148 2.85618 0.677515 3.97946 0.677515L6.01959 0.687148L6.2356 0.802741Z"></path>
                    <path
                        d="M11.6647 0.0658336C10.9783 0.31147 10.5079 0.899069 10.4119 1.63598C10.3879 1.82863 10.3687 2.80154 10.3687 3.79372C10.3687 4.7859 10.3879 5.75881 10.4119 5.95146C10.4983 6.59686 10.8583 7.11703 11.4391 7.42046L11.7319 7.57458H14.2041H16.6763L16.9643 7.42046C17.3339 7.2278 17.6267 6.93401 17.8187 6.56314L17.9723 6.27416V3.79372V1.31328L17.8187 1.02429C17.6267 0.653433 17.3339 0.359633 16.9643 0.166978L16.6763 0.0128531L14.2761 0.00322056C12.2024 -0.00641251 11.8471 0.00322056 11.6647 0.0658336ZM16.6043 0.802741C16.9019 0.956866 17.0267 1.08209 17.1611 1.35181L17.2811 1.583L17.2763 3.79854C17.2763 5.73472 17.2667 6.03816 17.1995 6.1682C17.0555 6.45237 16.9067 6.61131 16.6475 6.7558L16.3882 6.90029H14.2041H12.02L11.7799 6.77025C11.4967 6.62094 11.3767 6.49571 11.2231 6.20191L11.1079 5.98518V3.79372V1.60226L11.2231 1.38552C11.4247 0.995397 11.7079 0.778659 12.116 0.706413C12.2216 0.687148 13.2248 0.677515 14.3481 0.677515L16.3882 0.687148L16.6043 0.802741Z"
                    ></path>
                    <path d="M1.29608 10.4693C0.609639 10.7149 0.139209 11.3025 0.0432028 12.0394C-0.0144009 12.497 -0.0144009 15.8973 0.0432028 16.3549C0.129608 17.0003 0.489632 17.5205 1.07047 17.8239L1.36329 17.978H3.83545H6.30761L6.59563 17.8239C6.96525 17.6312 7.25807 17.3374 7.45008 16.9666L7.60369 16.6776V14.1972V11.7167L7.45008 11.4277C7.25807 11.0569 6.96525 10.7631 6.59563 10.5704L6.30761 10.4163L3.90745 10.4067C1.83372 10.397 1.4785 10.4067 1.29608 10.4693ZM6.2356 11.2062C6.52842 11.3603 6.65803 11.4855 6.79244 11.7504L6.90765 11.9768V14.2116V16.4416L6.74924 16.7017C6.53322 17.0677 6.2068 17.2604 5.74117 17.3037C5.54916 17.323 4.55549 17.3278 3.52343 17.3182L1.65131 17.3037L1.41129 17.1737C1.12807 17.0244 1.00807 16.8992 0.854455 16.6054L0.739248 16.3886V14.1972V12.0057L0.854455 11.789C1.05607 11.3988 1.33929 11.1821 1.74731 11.1099C1.85292 11.0906 2.85618 11.081 3.97946 11.081L6.01959 11.0906L6.2356 11.2062Z"></path>
                    <path d="M13.2441 10.4934C11.8856 10.8498 10.8583 11.8853 10.5079 13.2531C10.3735 13.7781 10.3735 14.6162 10.5079 15.1412C10.8343 16.4127 11.732 17.3808 12.9945 17.8239C13.3593 17.9491 13.4937 17.9732 14.0601 17.9925C14.617 18.0117 14.7754 17.9973 15.1162 17.9106C16.5179 17.5542 17.5452 16.5283 17.9052 15.1219C18.0348 14.6162 18.03 13.7685 17.9004 13.2531C17.55 11.8757 16.5179 10.8401 15.145 10.4885C14.6314 10.3585 13.7529 10.3585 13.2441 10.4934ZM15.2314 11.2784C15.7066 11.4518 16.0475 11.6782 16.4363 12.0828C17.0075 12.6848 17.2763 13.3639 17.2763 14.2068C17.2763 15.0882 17.0075 15.7288 16.3691 16.3645C15.721 17.0099 15.0826 17.2796 14.2186 17.2845C13.7001 17.2845 13.3113 17.193 12.8121 16.957C12.5336 16.8221 12.3608 16.692 12.0392 16.3694C11.396 15.724 11.132 15.0882 11.132 14.1972C11.132 13.3495 11.396 12.6896 11.972 12.0828C12.3608 11.6782 12.7017 11.4518 13.1817 11.2736C13.7913 11.0521 14.6218 11.0521 15.2314 11.2784Z"></path>
                </svg>
            </li>
        </ul>
        <a href="package-grid.html" class="primary-btn3 d-xl-flex d-none">Book A Trip</a>
        <div class="sidebar-button mobile-menu-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                <path
                    d="M0 4.46439C0 4.70119 0.0940685 4.92829 0.261511 5.09574C0.428955 5.26318 0.656057 5.35725 0.892857 5.35725H24.1071C24.3439 5.35725 24.571 5.26318 24.7385 5.09574C24.9059 4.92829 25 4.70119 25 4.46439C25 4.22759 24.9059 4.00049 24.7385 3.83305C24.571 3.6656 24.3439 3.57153 24.1071 3.57153H0.892857C0.656057 3.57153 0.428955 3.6656 0.261511 3.83305C0.0940685 4.00049 0 4.22759 0 4.46439ZM4.46429 11.6072H24.1071C24.3439 11.6072 24.571 11.7013 24.7385 11.8688C24.9059 12.0362 25 12.2633 25 12.5001C25 12.7369 24.9059 12.964 24.7385 13.1315C24.571 13.2989 24.3439 13.393 24.1071 13.393H4.46429C4.22749 13.393 4.00038 13.2989 3.83294 13.1315C3.6655 12.964 3.57143 12.7369 3.57143 12.5001C3.57143 12.2633 3.6655 12.0362 3.83294 11.8688C4.00038 11.7013 4.22749 11.6072 4.46429 11.6072ZM12.5 19.643H24.1071C24.3439 19.643 24.571 19.737 24.7385 19.9045C24.9059 20.0719 25 20.299 25 20.5358C25 20.7726 24.9059 20.9997 24.7385 21.1672C24.571 21.3346 24.3439 21.4287 24.1071 21.4287H12.5C12.2632 21.4287 12.0361 21.3346 11.8687 21.1672C11.7012 20.9997 11.6071 20.7726 11.6071 20.5358C11.6071 20.299 11.7012 20.0719 11.8687 19.9045C12.0361 19.737 12.2632 19.643 12.5 19.643Z"
                />
            </svg>
        </div>
    </div>
</header>
