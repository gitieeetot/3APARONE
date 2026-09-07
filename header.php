<?php $search_page = $search_page ?? 'SearchCourse.php'; ?>

<header class="header">
    <div class="logo">
        <a href="index.php">W</a>
    </div>

    <nav class="nav">
        <a href="Course.php" class="nav-link">Course</a>
        <a href="Yearlevel.php" class="nav-link">Year Level</a>
        <a href="Term.php" class="nav-link">Term</a>
        <a href="Section.php" class="nav-link">Section</a>
        <a href="SchoolYear.php" class="nav-link">School Year</a>
        <a href="Subjects.php" class="nav-link">Subjects</a>
    </nav>

    <a href="<?php echo $search_page; ?>" class="search" aria-label="Search" title="Search">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m21 21-4.34-4.34"/>
            <circle cx="11" cy="11" r="8"/>
        </svg>
    </a>
</header>