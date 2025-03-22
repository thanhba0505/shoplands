import React, { useState, useEffect, useCallback } from "react";
import {
  Button,
  TextField,
  Grid2,
  TableContainer,
  Table,
  TableRow,
  TableCell,
  TableBody,
  Avatar,
  styled,
  Autocomplete,
  Alert,
  Typography,
} from "@mui/material";
import CloudUploadIcon from "@mui/icons-material/CloudUpload";
import DeleteIcon from "@mui/icons-material/Delete";
import { useSnackbar } from "notistack";

const VisuallyHiddenInput = styled("input")({
  clip: "rect(0 0 0 0)",
  clipPath: "inset(50%)",
  height: 1,
  overflow: "hidden",
  position: "absolute",
  bottom: 0,
  left: 0,
  whiteSpace: "nowrap",
  width: 1,
});

const NewProducts = () => {
  const [name, setName] = useState("");
  const [images, setImages] = useState([]);
  const [description, setDescription] = useState("");
  const [categoryId, setCategoryId] = useState(null);
  const [productVariants, setProductVariants] = useState([]);
  const [attributesComplete, setAttributesComplete] = useState(false);

  const [countDetails, setCountDetails] = useState(0);
  const [valuesCounts, setValuesCounts] = useState([]);
  const [countAttributes, setCountAttributes] = useState(0);

  const { enqueueSnackbar } = useSnackbar();

  // State for product details
  const [details, setDetails] = useState([]);

  // State for product attributes
  const [attributes, setAttributes] = useState([]);

  const options = [
    { label: "The Godfather", id: 1 },
    { label: "Pulp Fiction", id: 2 },
  ];

  // Add or update a product detail
  const handleDetailChange = (index, field, value) => {
    const updatedDetails = [...details];
    if (!updatedDetails[index]) {
      updatedDetails[index] = { key: "", value: "" };
    }
    updatedDetails[index][field] = value;
    setDetails(updatedDetails);
  };

  // Add or update an attribute
  const handleAttributeChange = (
    attributeIndex,
    field,
    value,
    valueIndex = null
  ) => {
    const updatedAttributes = [...attributes];

    if (!updatedAttributes[attributeIndex]) {
      updatedAttributes[attributeIndex] = {
        name: "",
        values: Array(valuesCounts[attributeIndex] || 2).fill(""),
      };
    }

    if (field === "name") {
      updatedAttributes[attributeIndex].name = value;
    } else if (field === "value") {
      const values = [...updatedAttributes[attributeIndex].values];
      values[valueIndex] = value;
      updatedAttributes[attributeIndex].values = values;
    }

    setAttributes(updatedAttributes);

    // Check if all attributes are filled in after each change
    checkAttributesComplete(updatedAttributes);
  };

  // Check if all attributes and their values are filled in
  const checkAttributesComplete = useCallback(
    (attrs = attributes) => {
      if (attrs.length === 0 || countAttributes === 0) {
        setAttributesComplete(true);
        return;
      }

      const allComplete = attrs.every((attr, index) => {
        if (index >= countAttributes) return true;
        if (!attr || !attr.name) return false;

        return attr.values.every((value, idx) => {
          if (idx >= (valuesCounts[index] || 2)) return true;
          return !!value;
        });
      });

      setAttributesComplete(allComplete);
    },
    [attributes, countAttributes, valuesCounts]
  );

  // Generate all possible combinations of attribute values
  const generateVariants = useCallback(() => {
    if (attributes.length === 0) {
      // If no attributes, just return a single variant
      return [
        {
          price: "",
          promotion_price: "",
          quantity: "",
          attributes: [],
        },
      ];
    }

    // Filter out attributes with empty names or values
    const validAttributes = attributes.filter(
      (attr) => attr && attr.name && attr.values && attr.values.some((v) => v)
    );

    if (validAttributes.length === 0) return [];

    // Get all valid values from each attribute
    const attributeValues = validAttributes.map((attr) =>
      attr.values.filter((value) => value)
    );

    // Generate all combinations
    const generateCombinations = (arrays, current = [], index = 0) => {
      if (index === arrays.length) {
        return [current];
      }

      let results = [];
      for (let i = 0; i < arrays[index].length; i++) {
        results = results.concat(
          generateCombinations(
            arrays,
            [
              ...current,
              { name: validAttributes[index].name, value: arrays[index][i] },
            ],
            index + 1
          )
        );
      }
      return results;
    };

    const combinations = generateCombinations(attributeValues);

    // Create variant objects
    return combinations.map((combo) => ({
      price: "",
      promotion_price: "",
      quantity: "",
      attributes: combo,
    }));
  }, [attributes]);

  // Add a value to a specific attribute
  const handleAddValue = (attrIndex) => {
    const updatedCounts = [...valuesCounts];
    if (!updatedCounts[attrIndex]) {
      updatedCounts[attrIndex] = 2;
    }

    if (updatedCounts[attrIndex] < 10) {
      updatedCounts[attrIndex] += 1;

      // Update the values array for this specific attribute
      const updatedAttributes = [...attributes];
      if (updatedAttributes[attrIndex]) {
        const values = [...updatedAttributes[attrIndex].values];
        values.push("");
        updatedAttributes[attrIndex].values = values;
        setAttributes(updatedAttributes);
      }

      setValuesCounts(updatedCounts);
    }
  };

  // Remove a value from a specific attribute
  const handleRemoveValue = (attrIndex) => {
    const updatedCounts = [...valuesCounts];
    if (!updatedCounts[attrIndex]) {
      updatedCounts[attrIndex] = 2;
      setValuesCounts(updatedCounts);
      return;
    }

    if (updatedCounts[attrIndex] > 2) {
      updatedCounts[attrIndex] -= 1;

      // Update the values array for this specific attribute
      const updatedAttributes = [...attributes];
      if (updatedAttributes[attrIndex]) {
        updatedAttributes[attrIndex].values = updatedAttributes[
          attrIndex
        ].values.slice(0, updatedCounts[attrIndex]);
        setAttributes(updatedAttributes);
      }

      setValuesCounts(updatedCounts);
    }
  };

  // Add a new attribute row
  const addAttributeRow = () => {
    const newCount =
      countAttributes >= 3 ? countAttributes : countAttributes + 1;
    setCountAttributes(newCount);

    // Initialize the new row with 2 values
    if (newCount > attributes.length) {
      setAttributes([...attributes, { name: "", values: Array(2).fill("") }]);
      setValuesCounts([...valuesCounts, 2]);
    }
  };

  // Update variants when attributes change
  useEffect(() => {
    checkAttributesComplete();

    if (attributesComplete) {
      const newVariants = generateVariants();
      setProductVariants(newVariants);
    }
  }, [
    attributes,
    countAttributes,
    valuesCounts,
    attributesComplete,
    checkAttributesComplete,
    generateVariants,
  ]);

  // Update variant inputs
  const handleVariantInputChange = (variantIndex, field, value) => {
    const updatedVariants = [...productVariants];
    updatedVariants[variantIndex][field] = value;
    setProductVariants(updatedVariants);
  };

  // Handle file selection
  const handleFileChange = (event) => {
    const files = event.target.files;
    if (files && files.length > 0) {
      const newImages = Array.from(files);

      // Check if total images will exceed 7
      if (images.length + newImages.length <= 7) {
        setImages((prevImages) => [...prevImages, ...newImages]); // Add new images if total is <= 7
      } else {
        enqueueSnackbar("Tối đa tải lên 7 ảnh.", {
          variant: "error",
        });
      }
    }
  };

  // Handle form submission
  const handleSubmit = () => {
    // Format the data as requested
    const formattedVariants = productVariants.map((variant) => ({
      price: parseFloat(variant.price) || 0,
      promotion_price: parseFloat(variant.promotion_price) || 0,
      quantity: parseInt(variant.quantity) || 0,
      attributes: variant.attributes,
    }));

    // Format the product details
    const formattedDetails = details.map((detail) => ({
      name: detail.key,
      description: detail.value,
    }));

    // Create the complete data object
    const productData = {
      name,
      description,
      category_id: categoryId,
      product_details: formattedDetails,
      product_variants: formattedVariants,
    };

    // Log the formatted data
    console.log(JSON.stringify(productData, null, 2));

    // Here you would typically make an API call to save the product
    // axiosWithAuth.post('/api/products', productData);
  };

  // Render a variant row with inputs for price, promotion, and quantity
  const renderVariantRow = (variant, index) => {
    // Create a label for the variant
    const variantLabel =
      variant.attributes.length > 0 ? (
        <>
          Thuộc tính:{" "}
          <b>
            {variant.attributes
              .map((attr) => `${attr.name}: ${attr.value}`)
              .join(" | ")}
          </b>
        </>
      ) : (
        <>Không có thuộc tính</>
      );

    return (
      <React.Fragment key={index}>
        <Grid2 size={12}>{variantLabel}</Grid2>
        <Grid2 size={4}>
          <TextField
            variant="outlined"
            autoComplete="off"
            type="number"
            label="Giá gốc"
            placeholder="100000"
            size="small"
            fullWidth
            value={variant.price}
            onChange={(e) =>
              handleVariantInputChange(index, "price", e.target.value)
            }
          />
        </Grid2>
        <Grid2 size={4}>
          <TextField
            variant="outlined"
            autoComplete="off"
            type="number"
            label="Giá khuyến mãi"
            placeholder="80000"
            size="small"
            fullWidth
            value={variant.promotion_price}
            onChange={(e) =>
              handleVariantInputChange(index, "promotion_price", e.target.value)
            }
          />
        </Grid2>
        <Grid2 size={4}>
          <TextField
            variant="outlined"
            autoComplete="off"
            type="number"
            label="Tồn kho"
            placeholder="999"
            size="small"
            fullWidth
            value={variant.quantity}
            onChange={(e) =>
              handleVariantInputChange(index, "quantity", e.target.value)
            }
          />
        </Grid2>
      </React.Fragment>
    );
  };

  return (
    <Grid2 container spacing={2} sx={{ width: "100%", padding: 2 }}>
      <Grid2 size={12}>
        <TableContainer>
          <Table>
            <TableBody>
              {/* Tên sản phẩm */}
              <TableRow>
                <TableCell sx={{ verticalAlign: "top" }} width={"16%"}>
                  <Typography fontWeight={"semiBold"} sx={{ mt: 1 }}>
                    Tên sản phẩm
                  </Typography>
                </TableCell>
                <TableCell>
                  <TextField
                    variant="outlined"
                    autoComplete="off"
                    type="text"
                    label="Tên sản phẩm"
                    size="small"
                    fullWidth
                    value={name}
                    onChange={(e) => setName(e.target.value)}
                  />
                </TableCell>
                <TableCell
                  width={"360px"}
                  rowSpan={4}
                  sx={{ verticalAlign: "top" }}
                >
                  <Grid2
                    container
                    spacing={2}
                    justifyContent={"center"}
                    flexWrap="wrap"
                  >
                    {/* First image (120px) */}
                    <Grid2 size={12}>
                      <Avatar
                        sx={{
                          width: "120px",
                          height: "120px",
                          m: "auto",
                          padding: "2px",
                          border: "2px solid #ccc",
                        }}
                        variant="rounded"
                        src={images[0] ? URL.createObjectURL(images[0]) : null}
                      >
                        {!images[0] && "Ảnh"}
                      </Avatar>
                    </Grid2>

                    {/* Images with 80px size */}
                    {images.slice(1).map((file, index) => (
                      <Grid2 key={index} size={4}>
                        <Avatar
                          sx={{
                            width: "80px",
                            height: "80px",
                            m: "auto",
                            padding: "2px",
                            border: "2px solid #ccc",
                          }}
                          variant="rounded"
                          src={URL.createObjectURL(file)}
                        />
                      </Grid2>
                    ))}

                    {/* Upload button */}
                    <Grid2
                      container
                      size={12}
                      sx={{ textAlign: "center", mt: 2 }}
                      justifyContent={"center"}
                      spacing={2}
                    >
                      <Button
                        variant="outlined"
                        startIcon={<DeleteIcon />}
                        onClick={() => setImages([])}
                      >
                        Xóa tất cả
                      </Button>
                      <Button
                        component="label"
                        role={undefined}
                        variant="outlined"
                        tabIndex={-1}
                        startIcon={<CloudUploadIcon />}
                      >
                        Upload files
                        <VisuallyHiddenInput
                          type="file"
                          onChange={handleFileChange}
                          multiple
                        />
                      </Button>
                    </Grid2>
                  </Grid2>
                </TableCell>
              </TableRow>

              {/* Mô tả */}
              <TableRow>
                <TableCell sx={{ verticalAlign: "top" }}>
                  <Typography fontWeight={"semiBold"} sx={{ mt: 1 }}>
                    Mô tả
                  </Typography>
                </TableCell>
                <TableCell>
                  <TextField
                    variant="outlined"
                    multiline
                    rows={4}
                    autoComplete="off"
                    type="text"
                    label="Mô tả"
                    size="small"
                    fullWidth
                    value={description}
                    onChange={(e) => setDescription(e.target.value)}
                  />
                </TableCell>
              </TableRow>

              {/* Danh mục */}
              <TableRow>
                <TableCell sx={{ verticalAlign: "top" }}>
                  <Typography fontWeight={"semiBold"} sx={{ mt: 1 }}>
                    Danh mục
                  </Typography>
                </TableCell>
                <TableCell>
                  <Autocomplete
                    disablePortal
                    options={options}
                    size="small"
                    sx={{ width: 300 }}
                    onChange={(event, newValue) => {
                      setCategoryId(newValue ? newValue.id : null);
                    }}
                    renderInput={(params) => (
                      <TextField {...params} label="Danh mục" />
                    )}
                  />
                </TableCell>
              </TableRow>

              {/* Chi tiết sản phẩm */}
              <TableRow>
                <TableCell sx={{ verticalAlign: "top" }}>
                  <Typography fontWeight={"semiBold"} sx={{ mt: 1 }}>
                    Chi tiết sản phẩm
                  </Typography>
                </TableCell>
                <TableCell>
                  <Grid2 container spacing={2}>
                    <Grid2 size={12}>
                      <Typography variant="caption">
                        Thông tin chi tiết sản phẩm, ví dụ: Nơi sản xuất: Việt
                        Nam
                      </Typography>
                    </Grid2>
                    {Array.from({ length: countDetails }).map((_, index) => (
                      <React.Fragment key={index}>
                        <Grid2 size={4}>
                          <TextField
                            variant="outlined"
                            autoComplete="off"
                            type="text"
                            label="Từ khóa"
                            placeholder="Nơi sản xuất"
                            size="small"
                            fullWidth
                            value={details[index]?.key || ""}
                            onChange={(e) =>
                              handleDetailChange(index, "key", e.target.value)
                            }
                          />
                        </Grid2>
                        <Grid2 size={8}>
                          <TextField
                            variant="outlined"
                            autoComplete="off"
                            type="text"
                            label="Nội dung"
                            size="small"
                            placeholder="Việt Nam"
                            fullWidth
                            value={details[index]?.value || ""}
                            onChange={(e) =>
                              handleDetailChange(index, "value", e.target.value)
                            }
                          />
                        </Grid2>
                      </React.Fragment>
                    ))}

                    <Grid2>
                      <Button
                        fullWidth
                        variant="outlined"
                        color="error"
                        size="small"
                        disabled={countDetails <= 0}
                        onClick={() => {
                          const newCount =
                            countDetails > 0 ? countDetails - 1 : 0;
                          setCountDetails(newCount);
                          setDetails((prev) => prev.slice(0, newCount));
                        }}
                      >
                        Xóa 1 dòng
                      </Button>
                    </Grid2>

                    <Grid2>
                      <Button
                        fullWidth
                        color="info"
                        variant="outlined"
                        size="small"
                        disabled={countDetails >= 10}
                        onClick={() => {
                          const newCount =
                            countDetails >= 10
                              ? countDetails
                              : countDetails + 1;
                          setCountDetails(newCount);
                        }}
                      >
                        Thêm 1 dòng chi tiết
                      </Button>
                    </Grid2>
                  </Grid2>
                </TableCell>
              </TableRow>

              {/* Thuộc tính  */}
              <TableRow>
                <TableCell sx={{ verticalAlign: "top" }}>
                  <Typography fontWeight={"semiBold"} sx={{ mt: 1 }}>
                    Thuộc tính
                  </Typography>
                </TableCell>
                <TableCell colSpan={2}>
                  <Grid2 container spacing={2}>
                    <Grid2 size={12}>
                      <Typography variant="caption">
                        Các thuộc tính sản phẩm, ví dụ: (Màu: Xanh, Đỏ), (Size:
                        S, M, L){" "}
                      </Typography>
                    </Grid2>
                    {Array.from({ length: countAttributes }).map(
                      (_, attrIndex) => (
                        <React.Fragment key={attrIndex}>
                          <Grid2 size={3}>
                            <TextField
                              variant="outlined"
                              autoComplete="off"
                              type="text"
                              label="Thuộc tính"
                              placeholder="Màu"
                              size="small"
                              fullWidth
                              value={attributes[attrIndex]?.name || ""}
                              onChange={(e) =>
                                handleAttributeChange(
                                  attrIndex,
                                  "name",
                                  e.target.value
                                )
                              }
                            />
                          </Grid2>
                          <Grid2 container spacing={1} size={8}>
                            {Array.from({
                              length: valuesCounts[attrIndex] || 2,
                            }).map((_, valueIndex) => (
                              <Grid2 key={valueIndex} size={3}>
                                <TextField
                                  variant="outlined"
                                  autoComplete="off"
                                  type="text"
                                  label="Giá trị"
                                  size="small"
                                  fullWidth
                                  placeholder={`Giá trị ${valueIndex + 1}`}
                                  value={
                                    attributes[attrIndex]?.values?.[
                                      valueIndex
                                    ] || ""
                                  }
                                  onChange={(e) =>
                                    handleAttributeChange(
                                      attrIndex,
                                      "value",
                                      e.target.value,
                                      valueIndex
                                    )
                                  }
                                />
                              </Grid2>
                            ))}

                            <Grid2 size={12} container spacing={1}>
                              <Grid2>
                                <Button
                                  fullWidth
                                  variant="outlined"
                                  color="error"
                                  size="small"
                                  disabled={(valuesCounts[attrIndex] || 2) <= 2}
                                  onClick={() => handleRemoveValue(attrIndex)}
                                >
                                  Xóa 1 giá trị
                                </Button>
                              </Grid2>
                              <Grid2>
                                <Button
                                  fullWidth
                                  color="info"
                                  variant="outlined"
                                  size="small"
                                  disabled={
                                    (valuesCounts[attrIndex] || 2) >= 10
                                  }
                                  onClick={() => handleAddValue(attrIndex)}
                                >
                                  Thêm 1 giá trị
                                </Button>
                              </Grid2>
                            </Grid2>
                          </Grid2>
                        </React.Fragment>
                      )
                    )}

                    <Grid2>
                      <Button
                        variant="outlined"
                        color="error"
                        size="small"
                        disabled={countAttributes <= 0}
                        onClick={() => {
                          const newCount =
                            countAttributes > 0 ? countAttributes - 1 : 0;
                          setCountAttributes(newCount);
                          setAttributes((prev) => prev.slice(0, newCount));
                          setValuesCounts((prev) => prev.slice(0, newCount));
                        }}
                      >
                        Xóa 1 dòng
                      </Button>
                    </Grid2>

                    <Grid2>
                      <Button
                        color="info"
                        variant="outlined"
                        size="small"
                        disabled={countAttributes >= 3}
                        onClick={addAttributeRow}
                      >
                        Thêm 1 dòng thuộc tính
                      </Button>
                    </Grid2>
                  </Grid2>
                </TableCell>
              </TableRow>

              {/* Giá và tồn kho */}
              <TableRow>
                <TableCell sx={{ verticalAlign: "top" }}>
                  <Typography fontWeight={"semiBold"} sx={{ mt: 1 }}>
                    Giá và tồn kho
                  </Typography>
                </TableCell>
                <TableCell>
                  <Grid2 container spacing={2}>
                    {countAttributes > 0 && !attributesComplete ? (
                      <Grid2 size={12}>
                        <Alert severity="warning">
                          Hãy nhập đầy đủ thông tin thuộc tính
                        </Alert>
                      </Grid2>
                    ) : (
                      productVariants.map((variant, index) =>
                        renderVariantRow(variant, index)
                      )
                    )}
                  </Grid2>
                </TableCell>
              </TableRow>

              {/* Button */}
              <TableRow>
                <TableCell colSpan={3}>
                  <Grid2 container spacing={2}>
                    <Grid2 size={6}>
                      <Button
                        fullWidth
                        variant="outlined"
                        color="error"
                        size="large"
                      >
                        Hủy
                      </Button>
                    </Grid2>
                    <Grid2 size={6}>
                      <Button
                        fullWidth
                        color="info"
                        variant="contained"
                        size="large"
                        onClick={handleSubmit}
                        disabled={countAttributes > 0 && !attributesComplete}
                      >
                        Thêm sản phẩm
                      </Button>
                    </Grid2>
                  </Grid2>
                </TableCell>
              </TableRow>
            </TableBody>
          </Table>
        </TableContainer>
      </Grid2>
    </Grid2>
  );
};

export default NewProducts;
