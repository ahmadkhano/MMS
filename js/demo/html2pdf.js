// For data printing 
document.getElementById('generateReport').addEventListener('click', function () {
    var landscapeTables = document.querySelectorAll('#table6, #table5');
    var portraitTables = document.querySelectorAll('#table7, #table8, #table9');
  
    // Hide sorting icons before printing (jQuery version)
    $('.sorting, .sorting_asc, .sorting_desc').removeClass('sorting sorting_asc sorting_desc');
  
    // Temporarily switch to light mode for PDF
    document.body.classList.add('force-light-mode');
  
    function generatePDF(tables, orientation, filename) {
        var combinedHTML = '';
        tables.forEach(function (table) {
            var clonedTable = table.cloneNode(true);
  
            // Hide action buttons from print
            clonedTable.querySelectorAll('.hide-action-column').forEach(el => el.remove());
            combinedHTML += clonedTable.outerHTML;
        });
  
        html2pdf().from(combinedHTML).set({
            filename: filename,
            html2canvas: { 
                scale: 2,
                backgroundColor: '#ffffff', // Force white background
                ignoreElements: (element) => element.classList.contains('hide-action-column')
            },
            jsPDF: { 
                unit: 'mm', 
                format: 'a4', 
                orientation: orientation
            }
        }).toPdf().get('pdf').then(function (pdf) {
            var blob = pdf.output('blob');
            var url = URL.createObjectURL(blob);
            window.open(url, '_blank').focus();
        }).then(() => {
            document.body.classList.remove('force-light-mode'); // Restore original theme
        });
    }
  
    if (landscapeTables.length > 0) {
        generatePDF(landscapeTables, 'landscape', 'landscape_reports.pdf');
    }
    if (portraitTables.length > 0) {
        generatePDF(portraitTables, 'portrait', 'portrait_reports.pdf');
    }
  });
  // For data printing 