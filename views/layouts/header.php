<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<link rel="stylesheet" href="/../../assets/css/cards.css">


<style>
*{
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    margin:0;
    background:linear-gradient(135deg,#eef2f7,#dfe9f3);
}

/* ===== HEADER ===== */
.header{
    background:linear-gradient(90deg,#1e3c72,#2a5298);
    color:white;
    padding:22px 25px;
    margin-left:220px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    box-shadow:0 4px 15px rgba(0,0,0,.15);
}

.header-left{
    display:flex;
    align-items:center;
    gap:15px;
}

.menu-btn{
    font-size:24px;
    cursor:pointer;
}

.header-title{
    font-weight:600;
    font-size:18px;
}

.admin-text{
    font-size:14px;
    opacity:.9;
}

/* ===== SIDEBAR ===== */
.sidebar{
    width:220px;
    height:100vh;
    background:linear-gradient(180deg,#1e3c72,#2a5298);
    position:fixed;
    top:0;
    left:0;
    color:white;
    transition:.3s;
    box-shadow:3px 0 10px rgba(0,0,0,.1);
}

.sidebar.hide{
    left:-220px;
}

.sidebar h3{
    text-align:center;
    padding:22px 10px;
    margin:0;
    font-size:18px;
    background:rgba(255,255,255,.1);
}

/* MENU */
.sidebar ul{
    list-style:none;
    padding:10px 0;
    margin:0;
}

.sidebar ul li{
    margin:6px 0;
}

.sidebar ul li a{
    display:block;
    padding:12px 20px;
    color:white;
    text-decoration:none;
    border-radius:8px;
    margin:0 10px;
    transition:.3s;
}

.sidebar ul li a i{
    width:25px;
}

.sidebar ul li a:hover{
    background:rgba(255,255,255,.15);
    padding-left:25px;
}

/* LOGOUT */
.sidebar ul li a.logout{
    background:linear-gradient(90deg,#ff512f,#dd2476);
    text-align:center;
    font-weight:600;
}

.sidebar ul li a.logout:hover{
    opacity:.85;
}

/* ===== CONTENT WRAPPER ===== */
.content-wrapper{
    margin-left:220px;
    padding:25px;
    margin-top:20px;
}

/* ===== CARD ===== */
.card-container{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-bottom:30px; /* <<< TAMBAHAN INI SAJA */
}

.card{
    background:white;
    padding:25px;
    border-radius:14px;
    box-shadow:0 6px 18px rgba(0,0,0,0.08);
    transition:.3s;
}

.card:hover{
    transform:translateY(-6px);
}

.card h4{
    margin:0;
    font-size:15px;
    color:#666;
}

.card p{
    font-size:26px;
    font-weight:600;
    color:#2a5298;
}

/* ===== TABLE ===== */
.table-wrapper{
    background:white;
    padding:20px;
    border-radius:14px;
    box-shadow:0 6px 18px rgba(0,0,0,0.08);
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

th,td{
    padding:12px;
    text-align:center;
}

th{
    background:#1e3c72;
    color:white;
}

tr:nth-child(even){
    background:#f2f5ff;
}

tr:hover{
    background:#e3ebff;
}

/* ===== BUTTON ===== */
.btn-tambah{
    display:inline-block;
    padding:10px 16px;
    background:linear-gradient(90deg,#ff9800,#ffb74d);
    color:white;
    border-radius:8px;
    text-decoration:none;
    font-weight:600;
    margin-bottom:15px;
}

.btn-tambah:hover{
    opacity:.9;
}

.btn-kembali{
    background:#e74c3c;
    color:white;
    padding:8px 14px;
    text-decoration:none;
    border-radius:6px;
}

/* ===== FOOTER ===== */
.footer{
    margin-left:220px;
    background:linear-gradient(90deg,#1e3c72,#2a5298);
    color:white;
    text-align:center;
    padding:12px;
    position:fixed;
    bottom:0;
    width:calc(100% - 220px);
    font-size:14px;
}

/* ANIMATION */
.card, .table-wrapper{
    animation:fadeIn .5s ease-in-out;
}

@keyframes fadeIn{
    from{opacity:0; transform:translateY(10px);}
    to{opacity:1; transform:translateY(0);}
}

/* ===== FIX CONTENT KETUTUP SIDEBAR ===== */
.container{
    margin-left:220px;
    padding:25px;
    transition:.3s;
}

/* Saat sidebar disembunyikan */
.sidebar.hide ~ .container{
    margin-left:0;
}

/* ===== WARNA AKSI EDIT & HAPUS GLOBAL ===== */
td a{
    display:inline-block;
    padding:6px 12px;
    border-radius:6px;
    font-size:14px;
    font-weight:500;
    text-decoration:none;
    margin-right:6px;
}

/* EDIT */
td a:not(.hapus){
    background:#4facfe;
    color:white;
}

/* HAPUS */
td a.hapus{
    background:#ff4d4d;
    color:white;
}

</style>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>
