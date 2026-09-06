<?php $search_page = $search_page ?? 'SearchCourse.php'; ?>

<header class="header">
    <div class="logo">
        <a href="index.php">W</a>
    </div>

    <nav class="nav">
        <a href="Course.php">Course</a>
        <a href="Yearlevel.php">Year Level</a>
        <a href="Term.php">Term</a>
        <a href="Section.php">Section</a>
        <a href="SchoolYear.php">School Year</a>
        <a href="Subjects.php">Subjects</a>
        <a href="<?php echo $search_page; ?>" class="search" aria-label="Search" title="Search">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m21 21-4.34-4.34"/>
                <circle cx="11" cy="11" r="8"/>
            </svg>
        </a>
    </nav>
</header>