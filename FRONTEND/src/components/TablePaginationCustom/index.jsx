import { TablePagination } from "@mui/material";

const TablePaginationCustom = ({
  loading,
  count = 0,
  page,
  rowsPerPage,
  handleChangePage,
  handleChangeRowsPerPage,
  ...props
}) => {
  return (
    <TablePagination
      disabled={loading}
      component="div"
      count={count}
      page={page}
      onPageChange={handleChangePage}
      rowsPerPage={rowsPerPage}
      onRowsPerPageChange={handleChangeRowsPerPage}
      labelRowsPerPage="Số dòng mỗi trang"
      labelDisplayedRows={({ from, to, count }) =>
        `${from}-${to} trên ${count}`
      }
      {...props}
    />
  );
};

export default TablePaginationCustom;
