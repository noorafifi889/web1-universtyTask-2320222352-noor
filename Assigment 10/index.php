<?php
// TODO 1: Define an associative array of people (at least 3-4 people)
// Each person should have: name, role, skills (array), image url, and a theme color hex
$people = [
    [
        "name" => "Noor Alaa Al-Afifi",
        "role" => "Web Developer",
        "skills" => ["JavaScript", "React", "PHP", "HTML/CSS"],
        "image" => "https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150",
        "color" => "#81c784" // Green theme
    ],
    [
        "name" => "Ahmed Alaa Al-Afifi",
        "role" => "Computer Engineering",
        "skills" => ["C++", "Hardware", "Python", "Linux"],
        "image" => "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150",
        "color" => "#4fc3f7" // Blue theme
    ],
    [
        "name" => "Hala Alaa Al-Afifi",
        "role" => "Interior Design",
        "skills" => ["3D Max", "AutoCAD", "Decor", "UI Design"],
        "image" => "https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150",
        "color" => "#ce93d8" // Purple theme
    ]
];

// TODO 2: Handle search logic if the search query is set
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$filtered_people = $people;

if (!empty($search_query)) {
    $filtered_people = [];
    foreach ($people as $person) {
        // Search by name (case-insensitive)
        if (stripos($person['name'], $search_query) !== false) {
            $filtered_people[] = $person;
        }
    }
}

// TODO 4: Calculate stats (Total people count and Current Date)
$total_people = count($filtered_people);
$current_date = date("Y-m-d");
?>
<!DOCTYPE html><html lang="en" dir="ltr"><head>    
    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Task 01 - Profile Card Generator</title>    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">    
    <style>        
        * { margin: 0; padding: 0; box-sizing: border-box; }        
        body {            
            font-family: 'Inter', sans-serif;            
            background: #0f0f1a;            
            color: #e0e0e0;            
            line-height: 1.6;            
            min-height: 100vh;        
        }        
        .header {            
            background: linear-gradient(135deg, #1a1a2e, #2d1b3d);            
            padding: 30px 20px;            
            text-align: center;            
            border-bottom: 3px solid #ce93d8;        
        }        
        .header .logo-row {            
            display: flex; align-items: center; justify-content: center; gap: 15px; margin-bottom: 10px;        
        }        
        .header h1 { font-size: 1.8rem; color: #fff; margin-bottom: 5px; }        
        .header h1 span { color: #ce93d8; }        
        .header p { color: #aaa; font-size: 0.95rem; }
        .container { max-width: 1100px; margin: 0 auto; padding: 30px 20px; }
        .stats {            
            display: flex;            
            justify-content: center;            
            gap: 30px;            
            margin-bottom: 30px;            
            flex-wrap: wrap;        
        }        
        .stat-box {            
            background: rgba(255,255,255,0.05);            
            border: 1px solid rgba(255,255,255,0.08);            
            border-radius: 12px;            
            padding: 15px 30px;            
            text-align: center;        
        }        
        .stat-box .number { font-size: 2rem; font-weight: 800; color: #ce93d8; }        
        .stat-box .label { font-size: 0.85rem; color: #888; }
        .search-form {            
            text-align: center;            
            margin-bottom: 30px;        
        }        
        .search-form input[type="text"] {            
            background: rgba(255,255,255,0.05);            
            border: 1px solid rgba(255,255,255,0.1);            
            color: #e0e0e0;            
            padding: 12px 20px;            
            border-radius: 30px;            
            font-size: 1rem;            
            width: 300px;            
            outline: none;            
            font-family: 'Inter', sans-serif;        
        }        
        .search-form input[type="text"]:focus {            
            border-color: #ce93d8;        
        }        
        .search-form button {            
            background: #ce93d8;            
            color: #1a1a2e;            
            border: none;            
            padding: 12px 24px;            
            border-radius: 30px;            
            font-size: 1rem;            
            font-weight: 600;            
            cursor: pointer;            
            margin-left: 10px;            
            font-family: 'Inter', sans-serif;        
        }        
        .search-form button:hover { background: #e1bee7; }
        .cards-grid {            
            display: grid;            
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));            
            gap: 25px;        
        }        
        .card {            
            background: rgba(255,255,255,0.03);            
            border: 1px solid rgba(255,255,255,0.06);            
            border-radius: 16px;            
            overflow: hidden;            
            transition: transform 0.3s, box-shadow 0.3s;        
        }        
        .card:hover {            
            transform: translateY(-5px);            
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);        
        }        
        .card-color-bar { height: 5px; }        
        .card-body { padding: 25px; text-align: center; }        
        .card-body img {            
            width: 80px; height: 80px;            
            border-radius: 50%;            
            object-fit: cover;            
            margin-bottom: 15px;            
            border: 3px solid rgba(255,255,255,0.1);        
        }        
        .card-body h3 { color: #fff; font-size: 1.2rem; margin-bottom: 5px; }        
        .card-body .role {            
            font-size: 0.85rem;            
            font-weight: 600;            
            padding: 3px 12px;            
            border-radius: 20px;            
            display: inline-block;            
            margin-bottom: 12px;            
            background: rgba(255,255,255,0.1);
        }        
        .card-body .skills { color: #888; font-size: 0.85rem; }        
        .card-body .skills span {            
            display: inline-block;            
            background: rgba(255,255,255,0.05);            
            padding: 3px 10px;            
            border-radius: 12px;            
            margin: 3px;            
            font-size: 0.8rem;        
        }
        .no-results {            
            text-align: center;            
            padding: 50px 20px;            
            color: #666;            
            font-size: 1.1rem;        
        }
        .footer {            
            text-align: center;            
            padding: 30px 20px;            
            border-top: 1px solid rgba(255,255,255,0.05);            
            color: #555;            
            font-size: 0.9rem;        
        }
    </style>
</head>
<body>
<div class="header">    
    <div class="logo-row">        
        <img src="https://alaqsa.edu.ps/site/MainPage/Resources/img/logo.png" alt="Al-Aqsa University" style="width:50px;height:50px;border-radius:10px;object-fit:contain;background:#fff;padding:3px;">        
        <span style="color:#ccc;font-weight:600;">Al-Aqsa University</span>    
    </div>    
    <h1>Profile <span>Card Generator</span></h1>    
    <p>Week 11 - Task 01: PHP Arrays, Functions & Loops</p>
</div>
<div class="container">

    <!-- Stats Section -->    
    <div class="stats">        
        <div class="stat-box">            
            <div class="number"><?php echo $total_people; ?></div>            
            <div class="label">Total People</div>        
        </div>        
        <div class="stat-box">            
            <div class="number"><?php echo $current_date; ?></div>            
            <div class="label">Current Date</div>        
        </div>    
    </div>

    <!-- Search form -->    
    <form class="search-form" method="GET" action="">        
        <input type="text" name="search" placeholder="Search by name..." value="<?php echo htmlspecialchars($search_query); ?>">        
        <button type="submit">Search</button>    
    </form>    

    <!-- Display cards using foreach -->    
    <div class="cards-grid">                    
        <?php if (!empty($filtered_people)): ?>
            <?php foreach ($filtered_people as $person): ?>
                <div class="card">
                    <div class="card-color-bar" style="background-color: <?php echo $person['color']; ?>;"></div>
                    <div class="card-body">
                        <img src="<?php echo $person['image']; ?>" alt="<?php echo $person['name']; ?>">
                        <h3><?php echo $person['name']; ?></h3>
                        <span class="role" style="color: <?php echo $person['color']; ?>; background: <?php echo $person['color']; ?>22;">
                            <?php echo $person['role']; ?>
                        </span>
                        <div class="skills">
                            <?php foreach ($person['skills'] as $skill): ?>
                                <span><?php echo $skill; ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-results">                
                <p>No people found matching your search.</p>            
            </div>            
        <?php endif; ?>
    </div>

</div>
<div class="footer">    Al-Aqsa University - Web Development 1</div>
</body>
</html>