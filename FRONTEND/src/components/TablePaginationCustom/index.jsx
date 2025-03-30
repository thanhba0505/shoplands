import { TablePagination } from "@mui/material";

const TablePaginationCustom = ({
  loading,
  count = 0,
  page,
  rowsPerPage,
  handleChangePage,
  handleChangeRowsPerPage,
  rowsPerPageOptions = [10, 25, 50, 100],
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
      rowsPerPageOptions={rowsPerPageOptions}
      labelRowsPerPage="Số phần tử mỗi trang"
      labelDisplayedRows={({ from, to, count }) =>
        `${from}-${to} trên ${count}`
      }
      {...props}
    />
  );
};

export default TablePaginationCustom;
